<?php

namespace App\Http\Livewire\Raport\Sd;

use App\Models\Gurumapel;
use App\Models\KompetensiDasar;
use App\Models\Mapel;
use App\Models\Predikat;
use App\Models\Room;
use App\Models\SdNilaiPelajaran;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Penilaian extends Component
{
    public $loading = false;
    public $ta;
    public $semester;
    public $kelas;
    public $mapel;
    public $aspek;
    public $nilai;
    public $kkm;

    public $dataKelas;
    public $dataSiswa;
    public $dataMapel;
    public $dataNilai;
    public $dataKd;
    public $dataPredikat;
    public $dataCapaian;

    public $nick_name;
    public $name;
    public $siswa;

    protected $rules = [
        'kelas'     => 'required',
        'mapel'     => 'required',
        'aspek'     => 'required',
    ];

    public function mount()
    {
        $this->getDataSemester();
    }
    public function loadAll()
    {
        $this->getDataSiswa();
        $this->getDataKelas();
        $this->getDataMapel();
        $this->getDataNilai();
        $this->getDataKd();
        $this->getDataPredikat();
        $this->getDataCapaian(); 
        
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.raport.sd.penilaian');
    }

    public function getDataMapel()
    {
        $data = Gurumapel::join('mapels', 'mapels.idmapel', '=', 'gurumapels.mapel_id')
                        ->where('gurumapels.campus_id', Auth::user()->campus_id)
                        ->select('kode_mapel', 'nama_mapel', 'mapel_id')->get();
        $this->dataMapel = $data;
        if($this->mapel){
            $this->getKkm();
        }
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

    public function getDataSiswa()
    {
        $data = User::where('kelas', $this->kelas)->get();
        $this->dataKelas = $data;
    }

    public function createFormNilai()
    {
        $this->validate();
        $dataSiswa = User::where('kelas', $this->kelas)->select('id')->get();
        $dataKelas = Room::where('idkelas', $this->kelas)->select('tingkat')->first();

        foreach($dataSiswa as $items){
            $dataKd = KompetensiDasar::where('ta', $this->ta)->where('semester', $this->semester)
                            ->where('idmapel', $this->mapel)->where('kelas', $dataKelas->tingkat)
                            ->where('aspek', $this->aspek)->select('id')->get();
            foreach($dataKd as $item){
                SdNilaiPelajaran::create([
                    'ta'            => $this->ta,
                    'semester'      => $this->semester,
                    'user_id'       => $items->id,
                    'mapel_id'      => $this->mapel,
                    'aspek'         => $this->aspek,
                    'kd'            => $item->id,
                    'nilai'         => 0,
                ]);
            }
        }
    }

    public function getDataNilai()
    {
        $data = SdNilaiPelajaran::leftJoin('users', 'users.id', '=', 'sd_nilai_pelajarans.user_id')
                        ->leftJoin('registers', 'registers.user_id', '=', 'sd_nilai_pelajarans.user_id')
                        ->join('kompetensi_dasars', 'kompetensi_dasars.id', 'sd_nilai_pelajarans.kd')
                        ->where('sd_nilai_pelajarans.ta', $this->ta)->where('sd_nilai_pelajarans.semester', $this->semester)
                        ->where('mapel_id', $this->mapel)->where('sd_nilai_pelajarans.aspek', $this->aspek)
                        ->select('first_name', 'nick_name', 'nis', 'kode', 'nilai', 'users.id as idsiswa',  
                        'sd_nilai_pelajarans.id as id_nilai', 'sd_nilai_pelajarans.kd as idkd')->get();
        $this->dataNilai = $data;
    }

    public function getDataKd()
    {
        $data = KompetensiDasar::where('aspek', $this->aspek)->get();
        $this->dataKd = $data;
    }

    public function updateNilaiKd($id)
    {
        $this->validate([
            'nilai'     => 'required|integer|min:60|max:99',
        ]);
        $kd = SdNilaiPelajaran::findOrFail($id);
        $kd->update([
            'nilai'     => $this->nilai,
        ]); 
        $this->nilai = "";
    }

    public function getKkm()
    {
        $data = Mapel::findOrFail($this->mapel);
        $this->kkm = $data->kkm;
    }

    public function getDataPredikat()
    {
        $data = Predikat::where('campus_id', Auth::user()->campus_id)
                            ->where('jenis', 'Predikat')->get();
        $this->dataPredikat = $data;
    }

    public function getDataCapaian()
    {
        $data = Predikat::where('campus_id', Auth::user()->campus_id)
                            ->where('jenis', 'Capaian')->get();
        $this->dataCapaian = $data;
    }

    public function modalNickName($id, $name)
    {
        $this->siswa = $id;
        $this->name = $name;
        $this->emit('modalNickName');
    }

    public function updateNickName()
    {
        $this->validate([
            'nick_name'     => 'required',
        ]);

        $user = User::findOrFail($this->siswa);
        $user->update(['nick_name' => $this->nick_name]);
        $this->closeModal();
        $this->nick_name = "";
    }

    public function closeModal()
    {
        $this->emit('closeModal');
    }
}
