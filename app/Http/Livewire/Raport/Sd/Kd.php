<?php

namespace App\Http\Livewire\Raport\Sd;

use App\Models\Gurumapel;
use App\Models\KompetensiDasar;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Kd extends Component
{
    public $loading = false;
    public $notif = [];

    public $kelas;
    public $mapel;
    public $kode;
    public $ringkasan;
    public $aspek;
    public $idDelete;
    public $idEdit;

    public $ta;
    public $semester;
    public $dataKelas;
    public $dataMapel;
    public $dataPengetahuan;
    public $dataKdSumatif;

    protected $rules = [
        'kode'          => 'required',
        'ringkasan'     => 'required',
    ];

    public function mount()
    {
        $this->getDataKelas();
        $this->getDataMapel();
        $this->getDataSemester();
    }

    public function loadAll()
    {
        $this->getDataKelas();
        $this->getDataMapel();
        $this->getDataPengetahuan();
        $this->getDataKdSumatif();
        $this->getDataSemester();
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.sd.kd');
    }

    public function getDataSemester()
    {
        $data = Semester::where('is_active', 'true')->first();
        $this->ta = $data->tahun_ajaran;
        $this->semester = $data->semester_kode;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->dataKelas = $data;
    }

    public function getDataMapel()
    {
        $data = Gurumapel::join('mapels', 'mapels.idmapel', '=', 'gurumapels.mapel_id')
                        ->where('gurumapels.campus_id', Auth::user()->campus_id)->get();
        $this->dataMapel = $data;
    }

    public function getDataPengetahuan()
    {
        $data = KompetensiDasar::where('ta', $this->ta)->where('semester', $this->semester)
                            ->where('idmapel', $this->mapel)->where('kelas', $this->kelas)
                            ->where('aspek', 'Formatif')->get();
        $this->dataPengetahuan = $data;
    }

  
    public function getDataKdSumatif()
    {
        $data = KompetensiDasar::where('ta', $this->ta)->where('semester', $this->semester)
                            ->where('idmapel', $this->mapel)->where('kelas', $this->kelas)
                            ->where('aspek', 'Sumatif')->get();
        $this->dataKdSumatif = $data;
    }

    public function modalKd($aspek)
    {
        $this->aspek = $aspek;
        $this->emit('modalKd');
    }

    public function saveKd()
    {
        $this->validate();
        $data = [
            'ta'            => $this->ta,
            'semester'      => $this->semester,
            'idmapel'       => $this->mapel,
            'kelas'         => $this->kelas,
            'aspek'         => $this->aspek,
            'kode'          => $this->kode,
            'deskripsi'     => $this->ringkasan,
            'campus_id'     => Auth::user()->campus_id,
        ];
        $kd = KompetensiDasar::create($data);

        //$loadKelas = Room::where('idkelas', $this->kelas)->select('tingkat')->first();
        $cekDataNilai = SdNilaiPelajaran::where('kd', $kd->id)->count();
        if($cekDataNilai == 0){
            $users = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                        ->where('rooms.tingkat', $this->kelas)
                        ->select('users.id as userid')->get();
            foreach($users as $user){
                SdNilaiPelajaran::create([
                    'ta'        => $this->ta,
                    'semester'  => $this->semester,
                    'user_id'   => $user->userid,
                    'mapel_id'  => $this->mapel,
                    'aspek'     => $this->aspek,
                    'kd'        => $kd->id,
                    'nilai'     => 0,
                    'jenis'     => 'PH',
                    'non_test'      => 0,
                    'test'          => 0,
                    'na_semester'   => 0,
                    'tampil'    => 0,
                ]);
                SdNilaiPelajaran::create([
                    'ta'        => $this->ta,
                    'semester'  => $this->semester,
                    'user_id'   => $user->userid,
                    'mapel_id'  => $this->mapel,
                    'aspek'     => $this->aspek,
                    'kd'        => $kd->id,
                    'nilai'     => 0,
                    'jenis'     => 'PTS',
                    'non_test'      => 0,
                    'test'          => 0,
                    'na_semester'   => 0,
                    'tampil'    => 0,
                ]);
                SdNilaiPelajaran::create([
                    'ta'        => $this->ta,
                    'semester'  => $this->semester,
                    'user_id'   => $user->userid,
                    'mapel_id'  => $this->mapel,
                    'aspek'     => $this->aspek,
                    'kd'        => $kd->id,
                    'nilai'     => 0,
                    'jenis'     => 'PAS',
                    'non_test'      => 0,
                    'test'          => 0,
                    'na_semester'   => 0,
                    'tampil'    => 0,
                ]);
            }
        }

        $this->closeModal();
        $this->resetForm();
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data '.$this->aspek.' Berhasi ditambahkan!',
        ];
        $this->showAlert();

    }

    public function modalDelete($id)
    {
        $this->idDelete = $id;
        $this->emit('modalDelete');
    }

    public function deleteKd()
    {
        $data = KompetensiDasar::findOrFail($this->idDelete);
        $data->delete();
        
        SdNilaiPelajaran::where('kd', $this->idDelete)->delete();

        $this->closeModal();
        $this->notif = [
            'status'    => 500,
            'message'   => 'Data dihapus!',
        ];
        $this->showAlert();
    }

    public function modalEdit($id)
    {
        $this->idEdit = $id;
        $data = KompetensiDasar::findOrFail($this->idEdit);
        $this->kode = $data->kode;
        $this->ringkasan = $data->deskripsi;
        $this->aspek = $data->aspek;
        $this->emit('modalEdit');
    }

    public function updateKd()
    {
        $this->validate();
        $kd = KompetensiDasar::findOrFail($this->idEdit);
        $kd->update([
            'kode'      => $this->kode,
            'deskripsi' => $this->ringkasan,
        ]);
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data Diperbaharui!',
        ];
        $this->showAlert();
        $this->closeModal();
    }

    /**Action Komponen */
    public function closeModal()
    {
        $this->aspek = "";
        $this->idDelete = 0;
        $this->emit('closeModal');
    }

    public function resetForm()
    {
        $this->kode = "";
        $this->ringkasan = "";
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }
}
