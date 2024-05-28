<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Banner;
use App\Models\Campu;
use App\Models\Student;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): RedirectResponse
    {
        return redirect('/dashboard');
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
    public function show($id):view
    {
        $data = [
            'title'         => 'IQIS News',
            'berita'        => News::where('idnews', $id)->join('users', 'users.id', '=', 'news.user_id')->first(),
            'contact'       => Campu::where('idcampus', 1)->first(),
            'count_campus'  => Campu::count(),
            'count_siswa'   => User::where('status', 1)->where('level', 1)->count(),
            'count_guru'    => User::where('status', 1)->where('level', '<', 4)->count(),
        ];
        return view('news', $data);
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

    /** Validasi Data PPDB */
    public function data_validation($id):view
    {
        $data = [
            'title'     => 'Validasi Data PPDB',
            'ppdb'      => Student::join('users', 'users.id', '=', 'students.user_id')
                                    ->join('ppdbs', 'ppdbs.user_id', '=', 'students.user_id')
                                    ->where('public_token', $id)->first(),
        ];

        return view('validasi_ppdb', $data);
    }

}
