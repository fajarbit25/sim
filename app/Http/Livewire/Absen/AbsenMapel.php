<?php

namespace App\Http\Livewire\Absen;

use App\Models\Absen;
use App\Models\Gurumapel;
use App\Models\Room;
use App\Models\Semester;
use App\Models\Siswalog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AbsenMapel extends Component
{
    public $loading = false;
    public $kelas;
    public $dataKelas;
    public $ta;
    public $semester;
    public $search;
    public $dataAbsen;
    public $tanggal;
    public $idUpdate;
    public $presensi;
    public $keterangan = '-';
    public $tingkat;
    public $dataMapel;
    public $mapel;

    public $hadir = 0;
    public $izin = 0;
    public $sakit = 0;
    public $alfa = 0;
    public $sendAbsensiCount;

    public function mount()
    {
        $this->tanggal = date('Y-m-d');
        $this->getDataKelas();
    }

    public function render()
    {
        if($this->kelas){
            $this->getDataMapel();
        }
        return view('livewire.absen.absen-mapel');
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKelas = $data;
    }

    public function updatedkelas()
    {
        $this->getTingkat();
        $this->getDataMapel();
        $this->getDataAbsen();

    }

    public function updatedmapel()
    {
        $this->getDataAbsen();
        $this->getDataMapel();
    }

    public function getTingkat()
    {
        $data = Room::findOrFail($this->kelas);
        $this->tingkat = $data->tingkat;
    }

    public function getDataAbsen()
    {
        $this->getDataSemester();
        $data = Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                ->join('registers', 'registers.user_id', '=', 'absens.siswa_id')
                ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                ->where('ta', $this->ta)->where('semester', $this->semester)->where('mapel', $this->mapel)
                ->where('absens.kelas', $this->kelas)->where('tanggal_absen', $this->tanggal)
                ->select('idabsen', 'first_name', 'nis', 'nisn', 'gender', 'absensi', 'keterangan', 'absens.status')
                ->get();
        $this->dataAbsen = $data;
        $this->getCount();
    }

    public function updatedsearch()
    {
        $this->getDataSemester();
        $data = Absen::join('users', 'users.id', '=', 'absens.siswa_id')
                ->join('registers', 'registers.user_id', '=', 'absens.siswa_id')
                ->join('students', 'students.user_id', '=', 'absens.siswa_id')
                ->where('ta', $this->ta)->where('semester', $this->semester)->where('mapel', $this->mapel)
                ->where('absens.kelas', $this->kelas)->where('tanggal_absen', $this->tanggal)
                ->where('first_name', 'like', '%'.$this->search.'%')
                ->select('idabsen', 'first_name', 'nis', 'nisn', 'gender', 'absensi', 'keterangan', 'absens.status')
                ->get();
        $this->dataAbsen = $data;
    }


    public function getDataSemester()
    {
        $data = Semester::where('is_active', 'true')->first();
        $this->ta = $data->tahun_ajaran;
        $this->semester = $data->semester_kode;
    }

    public function generateAbsensi()
    {
        $users = User::where('kelas', $this->kelas)->get();
        foreach($users as $user){
            $cek = Absen::where('siswa_id', $user->id)->where('ta', $this->ta)->where('semester', $this->semester)
                    ->where('kelas', $this->kelas)->where('mapel', $this->mapel)->where('tanggal_absen', $this->tanggal)
                    ->where('campus_id', Auth::user()->campus_id)->count();
            if($cek <= 0){
                Absen::create([
                    'ta'        => $this->ta,
                    'semester'  => $this->semester,
                    'kelas'     => $this->kelas,
                    'mapel'     => $this->mapel,
                    'user_id'   => Auth::user()->id,
                    'siswa_id'  => $user->id,
                    'absensi'   => 'Hadir',
                    'keterangan'=> $this->keterangan,
                    'tanggal_absen' => $this->tanggal,
                    'status'    => '0',
                    'campus_id' => Auth::user()->campus_id,
                ]);
            }
        }

        $this->getDataAbsen();
        $this->getDataMapel();
    }

    public function modalPresensi($id)
    {
        $this->idUpdate = $id;
        $this->emit('modalPresensi');
        $this->getDataAbsen();
    }

    public function updatedpresensi()
    {
        $this->getDataAbsen();
    }

    public function updatePresensi()
    {
        $this->validate([
            'presensi'      => 'required',
        ]);
        $data = Absen::findOrFail($this->idUpdate);
        $data->update([
            'absensi'       => $this->presensi,
            'keterangan'    => $this->keterangan,
            'status'        => 0,
        ]);
        $this->emit('closeModal');
        $this->getDataAbsen();
        $this->idUpdate = "";
        $this->keterangan = '-';
        $this->presensi = "";
        $this->getCount();
    }

    public function getCount()
    {
        $this->getDataSemester();
        $data = Absen::where('ta', $this->ta)->where('semester', $this->semester)
                ->where('absens.kelas', $this->kelas)->where('mapel', $this->mapel)
                ->where('tanggal_absen', $this->tanggal)
                ->select('absensi', 'status')->get();
        $this->hadir = $data->where('absensi', 'Hadir')->count() ?? 0;
        $this->sakit = $data->where('absensi', 'Sakit')->count() ?? 0;
        $this->izin = $data->where('absensi', 'Izin')->count() ?? 0;
        $this->alfa = $data->where('absensi', 'Alfa')->count() ?? 0;
        $this->sendAbsensiCount = $data->where('status', 0)->count() ?? 0;
    }

    public function kirimNotifikasi()
    {
        $absen = Absen::where('ta', $this->ta)->where('semester', $this->semester)
                ->where('absens.kelas', $this->kelas)->where('tanggal_absen', $this->tanggal)
                ->where('status', 0)->select('idabsen', 'absensi', 'siswa_id')->get();
        foreach($absen as $item){
            $data = Absen::findOrFail($item->idabsen);
            $data->update([
                'status'    => 1,
            ]);

            //create Log
            Siswalog::create([
                'user_id'   => $item->siswa_id,
                'tanggal'   => date('Y-m-d'),
                'jam'       => date('H:i'),
                'tipe'      => 'Absensi Wali Kelas, Jam Pertama',
                'mapel_id'  => $item->absensi,
            ]);

            //Send notifikasi whatsApp Here
        }
        $this->getDataAbsen();
    }

    public function getDataMapel()
    {
        $data = Gurumapel::join('mapels', 'mapels.idmapel', '=', 'gurumapels.mapel_id')
                ->where('user_id', Auth::user()->id)->where('kelas', $this->tingkat)
                ->where('campus_id', Auth::user()->campus_id)->get();
        $this->dataMapel = $data;
    }
    
}
