<?php

namespace App\Http\Livewire\Tk\RaportMid;

use App\Models\Campu;
use App\Models\RaportMidTk;
use App\Models\RaportMidTKMaster;
use App\Models\RaportMidTkNilai;
use App\Models\RaportTKMaster;
use App\Models\Room;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Nilai extends Component
{
    public $loading = false;
    public $notif = [];

    public $campus;
    public $kelas;
    public $ta;
    public $semester;
    public $tanggal;
    public $siswa;
    public $deskripsi;
    public $catatan;
    public $idRaport;

    public $dataCampus;
    public $dataKelas;
    public $dataSiswa;
    public $dataTa;
    public $dataRaport;
    public $dataAgama;
    public $dataAll;
    public $kolomEdit;

    protected $rules = [
        'ta'        => 'required',
        'semester'  => 'required',
    ];


    
    public function loadAll()
    {
        $this->getDataCampus();
        $this->getDataKelas();
        $this->getDataSiswa();
        $this->getDataTa();
    }
    public function render()
    {
        $this->loadAll();
        return view('livewire.tk.raport-mid.nilai');
    }

    public function getDataCampus()
    {
        $data = Campu::where('idcampus', Auth::user()->campus_id)->get();
        $this->dataCampus = $data;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', $this->campus)
                    ->select('idkelas as id', 'kode_kelas')->get();
        $this->dataKelas = $data;
    }

    public function getDataSiswa()
    {
        $data = User::where('campus_id', $this->campus)->where('kelas', $this->kelas)
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->select('id', 'first_name', 'nis')->get();
        $this->dataSiswa = $data;
    }

    public function getDataTa()
    {
        $data = Semester::orderBy('created_at', 'DESC')->limit(20)->get();
        $this->dataTa = $data;
    }

    public function getDataRaport()
    {
        $data = RaportMidTk::where('campus', $this->campus)->where('kelas', $this->kelas)
                        ->where('ta', $this->ta)->where('semester', $this->semester)
                        ->where('user_id', $this->siswa)->first();
        $this->dataRaport = $data;
        $this->tanggal = $data->tanggal ?? "";
        $this->idRaport = $data->id ?? 0;
        $this->deskripsi = $data->deskripsi ?? "";
        $this->catatan = $data->catatan ?? "";
        $this->getDataAgama();
        $this->getDataAll();
    }


    public function createRaport()
    {
        $this->getDataRaport();
        if($this->idRaport == 0){
            $this->prosesCreateRaport();
            $this->getDataRaport();

            $this->notif = [
                'status'    => 200,
                'message'   => 'Berhasil membuat Rapor',
            ];
            $this->showAlert();
        }else{
            $this->getDataRaport();

            $this->notif = [
                'status'      => 400,
                'message'   => 'Gagal Memuat Rapor!'
            ];
            $this->showAlert();
        }
    }

    public function prosesCreateRaport()
    {
        $this->validate();
        $data = [
            'campus'    => $this->campus,
            'kelas'     => $this->kelas,
            'ta'        => $this->ta,
            'semester'  => $this->semester,
            'user_id'   => $this->siswa,
            'tanggal'   => $this->tanggal,
        ];
        $create = RaportMidTk::create($data);

        $loopingRaportFormat = RaportMidTKMaster::all();
        foreach($loopingRaportFormat as $items){
            RaportMidTkNilai::create([
                'user_id'       => $this->siswa,
                'id_raport'     => $create->id,
                'kategori'      => $items->kategori,
                'subkategori'   => $items->subkategori,
                'materi'        => $items->materi,
                'tujuan'        => $items->tujuan,
                'bsb'           => '-',
                'bsh'           => '-',
                'mb'            => '-',
                'bb'            => '-',
            ]);
        }
    }

    public function updateDataRaport()
    {
        $this->validate();
        $data = [
            'tanggal'   => $this->tanggal,
        ];

        RaportMidTk::where('campus', $this->campus)->where('kelas', $this->kelas)
                    ->where('ta', $this->ta)->where('semester', $this->semester)
                    ->where('user_id', $this->siswa)->update($data);
        
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data Raport Diperbaharui',
        ];
        
        
    }

    public function getDataAgama()
    {
        $data = RaportMidTkNilai::where('id_raport', $this->idRaport)->where('kategori', 'Agama')->get();
        $this->dataAgama = $data;
    }

    public function getDataAll()
    {
        $data = RaportMidTkNilai::where('id_raport', $this->idRaport)->where('kategori', '!=', 'Agama')->get();
        $this->dataAll = $data;
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }

    public function prosesPenilaian($id, $kolom)
    {
        $this->resetNilai($id);
        $nilai = RaportMidTkNilai::findOrFail($id);
        $nilai->update([
            'bsb'   => 'false',
            'bsh'   => 'false',
            'mb'    => 'false',
            'bb'    => 'false',
        ]);
        $nilai->update([
            $kolom => 'true',
        ]);
        $this->getDataAgama();
        $this->getDataAll();
    }

    public function  resetNilai($id)
    {
        $nilai = RaportMidTkNilai::findOrFail($id);
        $nilai->update([
            'bsb'   => '-',
            'bsh'   => '-',
            'mb'    => '-',
            'bb'    => '-',
        ]);
        $this->getDataAgama();
        $this->getDataAll();
    }

    public function modalDeskripsi($kolom)
    {
        $this-> getDataRaport(); 
        $this->kolomEdit = $kolom;
        $this->emit('modalDeskripsi');
    }
    public function updateDeskripsi()
    {
        $data = RaportMidTk::findOrFail($this->idRaport);
        $data->update([
            'deskripsi' => $this->deskripsi,
        ]);
        $this->getDataRaport();
        $this->emit('closeModalDeskripsi');
    }

    public function modalCatatan($kolom)
    {
        $this-> getDataRaport(); 
        $this->kolomEdit = $kolom;
        $this->emit('modalCatatan');
    }
    public function updateCatatan()
    {
        $data = RaportMidTk::findOrFail($this->idRaport);
        $data->update([
            'catatan' => $this->deskripsi,
        ]);
        $this->getDataRaport();
        $this->emit('closeModalCatatan');
    }
}
