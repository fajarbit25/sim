<?php

namespace App\Http\Controllers;

use App\Models\Confirmpayment;
use App\Models\Invoice;
use App\Models\Mutation;
use App\Models\Tipetransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class KeuanganController extends Controller
{
    public function __construct()
    {
        $this->middleware('finance');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():view
    {
        $data = [
            'title'     => 'Keuangan',
            'mutasi'    => Invoice::orderBy('idiv', 'DESC')->limit(10)->get(),
            'saldo'     => Mutation::where('campus_id', Auth::user()->campus_id)->orderBy('idmt', 'DESC')->first(),
        ];
        return view('keuangan.index',$data);
    }

    /** Table Transaksi */
    public function table_transaksi():view
    {
        $data = [
            'mutasi'    => Invoice::orderBy('idiv', 'DESC')
                                    ->join('tipetransactions', 'tipetransactions.idtt', '=', 'invoices.tipe_transaksi')
                                    ->where('invoices.campus_id', Auth::user()->campus_id)
                                    ->where('invoices.invoice_status', 'PAID')
                                    ->limit(10)->get(),
        ];
        return view('keuangan.table_transaksi',$data); 
    }

    /** Konfirmasi Keuangan */
    public function confirm():View
    {
        $data = [
            'title'     => 'Pembayaran Perlu Dikonfirmasi',
            'confirm'   => Confirmpayment::join('invoices', 'invoices.idiv', '=', 'confirmpayments.invoice_id')
                                            ->where('confirm_status', '0')->where('confirm_by', NULL)
                                            ->where('confirmpayments.campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('keuangan.admin_confirm_payment', $data);
    }

    /**Verify */
    public function verify($id):View
    {
        $data = [
            'title'     => 'Verifikasi Pembayaran',
            'verif'     => Invoice::where('kode_transaksi', $id)->join('confirmpayments','confirmpayments.invoice_id', '=', 'invoices.idiv')->first(),
        ];
        return view('keuangan.admin_verify_payment', $data);
    }

    /** Verify Action */
    public function confirm_verify(Request $request):RedirectResponse
    {
        $request->validate([
            'status'            => 'required',
            'kode_transaksi'    => 'required',
        ]);
        $kode = $request->kode_transaksi;
        $loadInvoice = Invoice::where('kode_transaksi', $kode)->first();
        $idiv = $loadInvoice->idiv;
        $loadConfirm = Confirmpayment::where('invoice_id', $idiv)->first();
        $idcp = $loadConfirm->idcp;

        /** Load Saldo Mutasi */
        $saldo = Mutation::where('campus_id', Auth::user()->campus_id)->orderBy('idmt', 'DESC')->first();

        Confirmpayment::where('idcp', $idcp)->update(['confirm_status' => 1, 'confirm_by' => Auth::user()->id]);
        Invoice::where('idiv', $idiv)->update(['invoice_status' => $request->status]);

        /**Insert data mutasi */
        $mutasi = [
            'inv_id'        => $loadInvoice->nomor_invoice,
            'nominal'       => $loadInvoice->amount,
            'saldo_awal'    => $saldo->saldo_akhir,
            'saldo_akhir'   => $saldo->saldo_akhir+$loadInvoice->amount,
            'campus_id'     => Auth::user()->campus_id,
            'trx_by'        => Auth::user()->id,
        ];
        Mutation::create($mutasi);

        return redirect('/finance/confirm')->with(['success' => 'Payment Confirm!']);
    }

    /** Mutasi */
    public function mutasi():View
    {
        $data = [
            'title'     => 'Mutasi Keuangan',
            'mutasi'    => Invoice::orderBy('idiv', 'DESC')->limit(10)->get(),
            'tipe'      => Tipetransaction::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('keuangan.mutasi',$data);
    }
    public function mutasi_filter(Request $request):view
    {
        $mulai = $request->mulai;
        $sampai = $request->sampai;

        if($request->jenis == 'ALL'){
            // $mutasix = Invoice::where('invoice_date', '>=', $mulai)->where('invoice_date', '<=', $sampai)->get();
            $mutasi = Mutation::join('invoices', 'invoices.nomor_invoice', '=', 'mutations.inv_id')
                                ->join('tipetransactions', 'tipetransactions.idtt', '=', 'invoices.tipe_transaksi')
                                ->where('invoices.invoice_date', '>=', $mulai)
                                ->where('invoices.invoice_date', '<=', $sampai)
                                ->where('invoices.invoice_status', 'PAID')
                                ->where('mutations.campus_id', Auth::user()->campus_id)->get();
        }else{
            // $mutasi = Invoice::where('invoice_date', '>=', $mulai)->where('invoice_date', '<=', $sampai)->where('jenis_transaksi', $request->jenis)->get();
            $mutasi = Mutation::join('invoices', 'invoices.nomor_invoice', '=', 'mutations.inv_id')
                                ->join('tipetransactions', 'tipetransactions.idtt', '=', 'invoices.tipe_transaksi')
                                ->where('invoices.invoice_date', '>=', $mulai)
                                ->where('invoices.invoice_date', '<=', $sampai)
                                ->where('invoices.tipe_transaksi', $request->jenis)
                                ->where('invoices.invoice_status', 'PAID')
                                ->where('mutations.campus_id', Auth::user()->campus_id)->get();
        }

        $data = [
            'title'     => 'Result Mutasi',
            'mutasi'    => $mutasi,
        ];
        return view('keuangan.filter',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create():view
    {
        $data = [
            'title'         => 'Transaksi',
            'mutasi'        => Invoice::orderBy('idiv', 'DESC')->limit(10)->get(),
            'saldo'         => Mutation::where('campus_id', Auth::user()->campus_id)->orderBy('idmt', 'DESC')->first(),
            'tipe'          => Tipetransaction::all(),
        ];
        return view('keuangan.transaksi', $data);       
    }

    /**Tipe Transaksi */
    public function tipe_transaksi_add(Request $request)
    {
        $request->validate([
            'tipe'      => 'required',
        ]);
        Tipetransaction::create(['tipe' => $request->tipe, 'campus_id'  => Auth::user()->campus_id]);
    }
    public function tipe_transaksi():view
    {
        $data = [
            'tipe'          => Tipetransaction::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('keuangan.tipe_transaksi', $data);
    }
    public function form_tipe():view
    {
        $data = [
            'tipe'          => Tipetransaction::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('keuangan.form_tipe', $data);
    }
    public function tipe_transaksi_delete(Request $request)
    {
        $request->validate([
            'idtt'  => 'required',
        ]);
        Tipetransaction::where('idtt', $request->idtt)->delete();
        return response(['success' => 'Deleted..']);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tipe'          => 'required',
            'jenis'         => 'required',
            'status'        => 'required',
            'keterangan'    => 'required',
            'amount'        => 'required',
        ]);

        /**Penomoran Invoice */
        $middleCode = 1009;

        /**Jenis Transaksi IN or OUT */
        if($request->jenis == 'OUT'){ 
            $nominal = '-'.$request->amount;
        }else{ 
            $nominal = $request->amount;
        }

        $data = [
            'user_id'           => Auth::user()->id,
            'jenis_transaksi'   => $request->jenis,
            'tipe_transaksi'    => $request->tipe,
            'kode_transaksi'    => date('y').$middleCode.rand(1111, 9999),
            'nomor_invoice'     => date('y').rand(1111, 9999),
            'invoice_date'      => date('Y-m-d'),
            'invoice_status'    => $request->status,
            'description'       => $request->keterangan,
            'campus_id'         => Auth::user()->campus_id,
            'amount'            => $nominal,
        ];

        if($request->status == 'PAID'){

            $invoice = Invoice::create($data);

            $saldo = Mutation::where('campus_id', Auth::user()->campus_id)->orderBy('idmt', 'DESC')->first();

            $mutasi = [
                'inv_id'        => $invoice->nomor_invoice,
                'nominal'       => $nominal,
                'saldo_awal'    => $saldo->saldo_akhir,
                'saldo_akhir'   => $saldo->saldo_akhir+$invoice->amount,
                'campus_id'     => $invoice->campus_id,
                'trx_by'        => Auth::user()->id,
            ];

            Mutation::create($mutasi);
            return response(['success' => 'Transaksi berhasil']);
        }else{
            $invoice = Invoice::create($data);
            return response(['success' => 'Something Wrong...']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function invoice($id)
    {
        $data = [
            'title'     => 'Transaksi TXID'.$id,
            'invoice'   => Invoice::where('kode_transaksi', $id)
                            ->where('invoices.campus_id', Auth::user()->campus_id)
                            ->join('tipetransactions', 'tipetransactions.idtt', '=', 'invoices.tipe_transaksi')
                            ->first(),
        ];
        return view('keuangan.invoice', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function typeJson($id)
    {
        $data = Tipetransaction::where('campus_id', $id)->get();
        return json_encode($data);
    }

}
