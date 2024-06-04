<?php

namespace App\Http\Controllers;

use App\Models\Campu;
use App\Models\Jenjang;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;

class CampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():view
    {
        $data = [
            'title'     => 'Informasi Kampus',
            'campus'    => Campu::join('jenjangs', 'jenjangs.idjenjang', '=', 'campus.campus_tingkat')->get(),
            'jenjang'   => Jenjang::all(),
        ];
        return view('campus.index', $data);
    }

    /**
     * load data dalam table
     */
    public function table():view
    {
        $data = [
            'campus'    => Campu::join('jenjangs', 'jenjangs.idjenjang', '=', 'campus.campus_tingkat')->get(),
        ];
        return view('campus.table', $data);
    }

    /**
     * Pencarian ajax
     */
    public function search($key)
    {
        $data = [
            'campus'     => Campu::join('jenjangs', 'jenjangs.idjenjang', '=', 'campus.campus_tingkat')
                                ->where('campus_name', 'like', "%".$key."%")
                                ->orwhere('campus_initial', 'like', "%".$key."%")
                                ->orwhere('campus_contact', 'like', "%".$key."%")
                                ->orwhere('campus_kepsek', 'like', "%".$key."%")
                                ->orwhere('campus_alamat', 'like', "%".$key."%")
                                ->paginate(1000),
        ];
        return View('campus.table', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(Request $request):RedirectResponse
    {
        // $request->validate([
        //     'campus_name'       => 'required|unique:campus',
        //     'campus_initial'    => 'required|unique:campus',
        //     'campus_tingkat'    => 'required',
        //     'campus_contact'    => 'required',
        //     'campus_kepsek'     => 'required',
        //     'niy_kepsek'        => 'required',
        //     'campus_alamat'     => 'required',
        //     'yt'                => 'required',
        //     'fb'                => 'required',
        //     'ig'                => 'required',
        //     'tele'              => 'required',
        //     'email_campus'      => 'required',
        // ]);
        // $data = [
        //     'campus_name'       => $request->campus_name,
        //     'campus_initial'    => $request->campus_initial,
        //     'campus_tingkat'    => $request->campus_tingkat,
        //     'campus_contact'    => $request->campus_contact,
        //     'campus_kepsek'     => $request->campus_kepsek,
        //     'campus_alamat'     => $request->campus_alamat,
        //     'yt'                => $request->yt,
        //     'fb'                => $request->fb,
        //     'ig'                => $request->ig,
        //     'tele'              => $request->tele,
        //     'email_campus'      => $request->email_campus,
        // ];

        // Campu::create($data);
        return redirect('/campus')->with(['warning' => 'Penambahan data Satuan Pendidikan Tidak Diizinkan!.']);
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
        $data = Campu::where('idcampus', $id)->first();
        return json_encode($data);
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
        //$id = $request->idcampus;
        $data = [
            'campus_initial'  => $request->campus_initial,
            'campus_name'     => $request->campus_name,
            'campus_tingkat'  => $request->campus_tingkat,
            'campus_kepsek'   => $request->campus_kepsek,
            'campus_contact'  => $request->campus_contact,
            'niy_kepsek'      => $request->niy_kepsek,
            'campus_alamat'   => $request->campus_alamat,
            'yt'              => $request->yt,
            'fb'              => $request->fb,
            'ig'              => $request->ig,
            'tele'            => $request->tele,
            'email_campus'    => $request->email_campus,
        ];
        $update = Campu::where('idcampus', $id)->update($data);
        return response(['success' => 'Data updated']);
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
