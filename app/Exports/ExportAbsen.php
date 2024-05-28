<?php

namespace App\Exports;

use App\Models\Absen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExportAbsen implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $kelas;
    protected $mapel;
    protected $tanggal;

    public function __construct($kelas, $mapel, $tanggal)
    {
        $this->kelas = $kelas;
        $this->mapel = $mapel;
        $this->tanggal = $tanggal;
    }

    public function view():view
    {
        return view('absen.excel', [
            'absen'  => Absen::join('rooms', 'rooms.idkelas', '=', 'absens.kelas')
                                ->join('registers', 'registers.user_id', '=', 'absens.siswa_id')
                                ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                                ->join('mapels', 'mapels.idmapel', 'absens.mapel')
                                ->join('users', 'users.id', '=', 'absens.siswa_id')
                                ->where('absens.kelas', $this->kelas)->where('mapel', $this->mapel)
                                ->where('tanggal_absen', $this->tanggal)->where('absens.status', 'close')
                                ->select('rooms.kode_kelas', 'mapels.nama_mapel', 'tanggal_absen', 'students.nisn',
                                'registers.nis', 'users.first_name', 'students.gender', 'absensi')
                                ->get(),
        ]);
    }
}

