<?php

namespace App\Http\Controllers;

use App\Models\Campu;
use App\Models\Confirmpayment;
use App\Models\Invoice;
use App\Models\Score;
use App\Models\Semester;
use App\Models\Siswalog;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class OrangtuaController extends Controller
{
    /**Construc */
    public function __construct()
    {
        
    }
    /**
     * 
     * Statistik.
     * 
    */
    public function index():view
    {
        $id = Auth::user()->id;
        $semester = Semester::where('is_active', 'true')->first();
        $semesterKode = $semester->semester_kode;
        $ta = $semester->tahun_ajaran;

        $data = [
            'title'     => 'Statistik Siswa',
            'campus'    => Campu::where('idcampus', Auth::user()->campus_id)->first(),
            'students'  => Student::where('user_id', $id)->first(),
            'nilai'     => Score::where('siswa_id', $id)->where('semester', '!=', $semesterKode)->where('ta', '!=',  $ta)
                            ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')->get(),
        ];
        return view('ortu.index', $data);
    }


    /**
     * 
     * Nilai Tahfidz.
     *
     */
    public function tahfidz($id):View
    {
        $data = [
            'title'         => 'Tahfidz',
        ];
        return view('ortu.tahfidz', $data);
    }

    /**
     * 
     * E-Raport.
     * 
    */
    public function eraport()
    {
        $id = Auth::user()->id;
        $semester = Semester::where('is_active', 'true')->first();
        $semesterKode = $semester->semester_kode;
        $ta = $semester->tahun_ajaran;

        $data = [
            'title'     => 'E-Raport',
            'campus'    => Campu::where('idcampus', Auth::user()->campus_id)->first(),
            'students'  => Student::where('user_id', $id)->first(),
            'nilai'     => Score::where('siswa_id', $id)->where('semester', $semesterKode)->where('ta', $ta)
                            ->join('mapels', 'mapels.idmapel', '=', 'scores.mapel')->get(),
            'semester'  => $semesterKode,
            'ta'        => $ta,
        ];
        return view('ortu.eraport', $data);
    }


    /**
     * Invoice
    */
    public function invoice():view
    {
        $data = [
            'title'     => 'Invoice',
            'invoice'   => Invoice::where('user_id', Auth::user()->id)
                            ->join('tipetransactions', 'tipetransactions.idtt', '=', 'invoices.tipe_transaksi')
                            ->join('confirmpayments', 'confirmpayments.invoice_id', '=', 'invoices.idiv')->get(),
        ];
        return view('ortu.invoice', $data);
    }
    public function showInvoice($id)
    {
        $loadinv = Invoice::where('nomor_invoice', $id)->first();
        $idinv = $loadinv->idiv;
        $data = [
            'title'     => '#'.$id,
            'invoice'   => Invoice::where('nomor_invoice', $id)
                            ->join('tipetransactions', 'tipetransactions.idtt', '=', 'invoices.tipe_transaksi')->first(),
            'confirm'   => Confirmpayment::where('invoice_id', $idinv)->first(),
        ];
        return view('ortu.showInvoice', $data);
    }
    public function showEviden($id)
    {
        $data = Confirmpayment::where('invoice_id', $id)->first();
        return response()->json($data);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
