<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;


class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():view
    {
        $data = [
            'title'     => 'Mata Pelajaran',
        ];
        return view('mapel.index', $data);
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
        $request->validate([
            'kode_mapel'    => 'required|max:6',
            'nama_mapel'    => 'required',
            'jenis'         => 'required',
            'kkm'           => 'required',
        ]);

        $data = [
            'jenis'         => $request->jenis,
            'kkm'           => $request->kkm,
            'kode_mapel'    => $request->kode_mapel,
            'nama_mapel'    => $request->nama_mapel,
            'mapel_campus'  => Auth::user()->campus_id,
            'is_active'     => 1,
        ];

        Mapel::create($data);
        return redirect('/mapel')->with(['success' => 'Mapel ditambahkan!']);
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
        return json_encode(Mapel::where('idmapel', $id)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $data = [
            'kode_mapel'    => $request->kode_mapel,
            'nama_mapel'    => $request->nama_mapel,
            'jenis'         => $request->jenis,
            'kkm'           => $request->kkm,
        ];
        Mapel::where('idmapel', $request->idmapel)->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Mapel::where('idmapel', $request->idmapel)->delete();
    }

    public function table():view
    {
        $data = [
            'mapel'     => Mapel::where('mapel_campus', Auth::user()->campus_id)->paginate(10),
        ];
        return view('mapel.tabel', $data);
    }

    public function search($key):view
    {
        $data = [
            'mapel'     => Mapel::orWhere('kode_mapel','like',"%".$key."%")
                                ->orWhere('nama_mapel','like',"%".$key."%")->paginate(1000),
        ];
        return view('mapel.tabel', $data);
    }
}
