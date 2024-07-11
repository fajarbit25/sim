<?php

namespace App\Http\Livewire\Raport\Km;

use App\Models\Room;
use App\Models\Saran;
use App\Models\Semester;
use App\Models\TahfidzFaturrahman;
use App\Models\TahfidzNilai;
use App\Models\TahfidzObject;
use App\Models\TahfidzSurah;
use App\Models\TahsinCatatan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Tahfidz extends Component
{
    public $dataKelas;
    public $kelas;
    public $tingkat;
    public $key;
    public $dataSurah;
    public $dataObject;
    public $dataNilai;
    public $nilai;
    public $saran;
    public $dataSaran;
    public $idEditSaran;

    public $ta;
    public $semester;

    public $nickName;
    public $namaLengkap = "";
    public $idEditName;

    public function mount()
    {
        $this->getDataKelas();
        $this->getDataSemester();
    }

    public function render()
    {
        if($this->kelas){
            $this->getDataNilai();
            $this->getDataObjek();
            $this->getDataSaran();
        }
        return view('livewire.raport.km.tahfidz');
    }

    public function getDataNilai()
    {
        $data = TahfidzNilai::join('users', 'users.id', '=', 'tahfidz_nilais.user_id')
                ->join('students', 'students.user_id', '=', 'tahfidz_nilais.user_id')
                ->join('tahfidz_surahs', 'tahfidz_surahs.id', '=', 'tahfidz_nilais.id_surah')
                ->where('tahfidz_nilais.campus_id', Auth::user()->campus_id)->where('tahfidz_nilais.ta', $this->ta)
                ->where('tahfidz_nilais.semester', $this->semester)->where('tahfidz_nilais.kelas', $this->kelas)
                ->select('tahfidz_nilais.id', 'first_name as name', 'nisn', 'nick_name', 'bahasa', 'nilai', 
                'tahfidz_nilais.user_id', 'tahfidz_surahs.id as idsurah', 'arab')
                ->orderBy('tahfidz_surahs.id', 'ASC')->get();
        $this->dataNilai = $data;
    }

    public function updatedkey()
    {
        $this->getDataSurah();
        $this->getDataObjek();

    }

    public function getDataSemester()
    {
        $data = Semester::where('is_active', 'true')->first();
        $this->ta = $data->tahun_ajaran;
        $this->semester = $data->semester_kode;
    }

    public function getDataSurah()
    {
        $data = TahfidzSurah::where('bahasa', 'like', '%'.$this->key.'%')->get();
        $this->dataSurah = $data;
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->select('idkelas', 'tingkat', 'kode_kelas')->get();
        $this->dataKelas = $data;
    }

    public function modalSurah()
    {
        $this->emit('modalSurah');
        $this->getDataObjek();
    }

    public function updatedkelas()
    {
        $data = Room::findOrFail($this->kelas);
        $this->tingkat = $data->tingkat;
        $this->getDataObjek();
        $this->getDataNilai();

    }

    public function addSurah($id)
    {
        $data = [
            'ta'        => $this->ta,
            'semester'  => $this->semester,
            'tingkat'   => $this->tingkat,
            'surah_id'  => $id,
            'campus_id' => Auth::user()->campus_id,
        ];
        TahfidzObject::create($data);
        $this->getDataObjek();
    }

    public function getDataObjek()
    {
        $data = TahfidzObject::join('tahfidz_surahs', 'tahfidz_surahs.id', '=', 'tahfidz_objects.surah_id')
                    ->where('ta', $this->ta)->where('semester', $this->semester)->where('tingkat', $this->tingkat)
                    ->select('tahfidz_objects.id', 'tahfidz_surahs.bahasa')->get();
        $this->dataObject = $data;
    }

    public function getDataSaran()
    {
        $data = TahsinCatatan::where('ta', $this->ta)->where('semester', $this->semester)
                            ->where('kelas', $this->kelas)->select('id', 'user_id', 'catatan')
                            ->get();
        $this->dataSaran = $data;
    }

    public function modalSaran($id)
    {
        $saran = TahsinCatatan::findOrFail($id);
        $this->saran = $saran->catatan;
        $this->idEditSaran = $saran->id;
        $this->emit('modalSaran');
    }

    public function updateSaran()
    {
        $data = TahsinCatatan::findOrFail($this->idEditSaran);
        $data->update([
            'catatan'       => $this->saran,
        ]);
        $this->emit('closeModal');
    }

    public function deleteOject($id)
    {
        $object = TahfidzObject::findOrFail($id);
        $object->delete();
        $this->getDataObjek();
    }

    public function generate()
    {
        /**Load User */
        $users = User::where('campus_id', Auth::user()->campus_id)->where('kelas', $this->kelas)
                    ->select('id')->get();
        foreach($users as $user){
            /**Loop Object */
            $objects = TahfidzObject::where('ta', $this->ta)->where('semester', $this->semester)
                        ->where('tingkat', $this->tingkat)->where('campus_id', Auth::user()->campus_id)->get();
            foreach($objects as $object){
                /**Cek Nilai */
                $cekNilai = TahfidzNilai::where('campus_id', Auth::user()->campus_id)->where('ta', $this->ta)
                                ->where('semester', $this->semester)->where('kelas', $this->kelas)
                                ->where('user_id', $user->id)->where('id_surah', $object->surah_id)->count();
                if($cekNilai == 0){
                    /**create form nilai */
                    TahfidzNilai::create([
                        'campus_id'         => Auth::user()->campus_id,
                        'ta'                => $this->ta,
                        'semester'          => $this->semester,
                        'kelas'             => $this->kelas,
                        'user_id'           => $user->id,
                        'id_surah'          => $object->surah_id,
                        'nilai'             => 0,
                        'send'              => 0,
                    ]);

                }//Endif cek nilai
            }//Endforeach Object

             /**create Faturrahman */
             if($this->tingkat == '7'){
                TahfidzFaturrahman::create([
                    'campus_id'         => Auth::user()->campus_id,
                    'ta'                => $this->ta,
                    'semester'          => $this->semester,
                    'kelas'             => $this->kelas,
                    'user_id'           => $user->id,
                    'deskripsi'         => '-',
                    'nilai'             => 0,
                ]);
            }

            /**Create Saran */
            TahsinCatatan::create([
                'ta'                => $this->ta,
                'semester'          => $this->semester,
                'kelas'             => $this->kelas,
                'user_id'           => $user->id,
                'catatan'           => 'none',
                'tanggal_rapor'     => date('Y-m-d'),
            ]);

        }//Endforeach Users
        $this->getDataNilai();
    }

    public function modalNickName($id)
    {
        $user = User::findOrFail($id);
        $this->idEditName = $user->id;
        $this->namaLengkap = $user->first_name;
        $this->emit('modalNickName');
        $this->getDataNilai();

    }

    public function updatednickName()
    {
        $this->getDataNilai();
    }

    public function updateNickName()
    {
        $user = User::findOrFail($this->idEditName);
        $user->update([
            'nick_name'     => $this->nickName,
        ]);
        $this->getDataNilai();
        $this->emit('closeModal');
        $this->nickName = "";
    }

    public function updateNilai($id)
    {
        $this->validate([
            'nilai'     => 'required|integer|min:59|max:99',
        ]);
        $nilai = TahfidzNilai::findOrFail($id);
        $nilai->update([
            'nilai'     => $this->nilai,
        ]);
        $this->nilai = "";
    }
}
