<?php

namespace App\Http\Livewire\Tk\Rppmdiniyah;

use App\Models\Room;
use App\Models\RppmDiniyah;
use App\Models\RppmdiniyahMaster;
use App\Models\RppmdiniyahMateri;
use App\Models\RppmdiniyahNilai;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Form extends Component
{
    public $loading = false;
    public $tk;
    public $semester;
    public $bulan;
    public $pekan;
    public $kelompok = [];
    public $kelas;
    public $topik;
    public $subtopik;
    public $materi;
    public $kegiatan;

    public $count;
    public $resultMateri;
    public $resultNilai;
    public $siswa = [];
    public $resultFormMateri = [];
    public $resultFormKegiatan = [];
    public $countMateri;
    public $manualForm;
    public $idPrint;
    public $idDelete;

    protected $rules = [
        'topik'     => 'required',
        'subtopik'  => 'required',
    ];
    
    public function render()
    {
        $this->countMateri();
        $this->loadResultMateri();
        $this->loadKelompok();
        $this->loadDataSiswa();
        $this->loadResultFormMateri();
        $this->loadResultFormKegiatan();
        $this->loadCountMateri();

        if($this->count == 0){
            $this->topik = $this->topik;
            $this->subtopik = $this->subtopik;
        }else{
            $this->loadTopik();
            $this->loadSubTopik();
        }
        return view('livewire.tk.rppmdiniyah.form', [
            'countMateri'   => $this->count,
            'resultMateri'  => $this->resultMateri,
            'topik'         => $this->topik,
            'subtopik'      => $this->subtopik,
            'kelompok'      => $this->kelompok,
            'siswa'         => $this->siswa,
            'resultFormMateri'  => $this->resultFormMateri,
            'resultFormKegiatan'=> $this->resultFormKegiatan,
            'countMateriGroup' => $this->countMateri,
            'idPrint'          => $this->idPrint,
        ]);
    }

    public function countMateri()
    {
        $data =  RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                            ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                            ->where('kelompok_id', $this->kelas)->count();
        $row = $data ?? 0;
        $this->count = $row;
    }

    public function addMateri()
    {
        $this->validate();
        $this->loadResultFormMateri();
        $this->emit('addMateri');
    }

    public function createRppmDiniyah()
    {
        $this->validate();

        if($this->materi == 'Pembukaan'){
            $segment = '1';
        }else{
            $segment = '2';
        }

        if($this->kegiatan == 'DIISI SENDIRI'){
            $kegiatan = $this->manualForm;
        }else{
            $kegiatan = $this->kegiatan;
        }

        $data = [
            'campus_id'     => Auth::user()->campus_id,
            'semester'      => $this->semester,
            'bulan'         => $this->bulan,
            'pekan'         => $this->pekan,
            'kelompok_id'   => $this->kelas,
            'topik_id'      => $this->topik,
            'subtopik_id'   => $this->subtopik,
            'segment_materi'=> $segment,
            'materi'        => $this->materi,
            'kegiatan'      => $kegiatan,
        ];

        $create = RppmDiniyah::create($data);

        $users = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                        ->where('users.campus_id', Auth::user()->campus_id)
                        ->where('rooms.kode_kelas', $this->kelas)->get();
        foreach($users as $user){
            $dataNilai = [
                'user_id'           => $user->id,
                'rppm_diniyah_id'   => $create->id,
                'nilai'             => '-',
            ];
            RppmdiniyahNilai::create($dataNilai);
        }

    }

    public function loadSubTopik()
    {
        $data = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                        ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                        ->where('kelompok_id', $this->kelas)->first();
        $this->subtopik = $data->subtopik_id;
    }

    public function loadTopik()
    {
        $data = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                        ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                        ->where('kelompok_id', $this->kelas)->first();
        $this->topik = $data->topik_id;
        $this->idPrint = $data->id;
    }
    
    public function loadResultMateri()
    {
        $data = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                        ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                        ->where('kelompok_id', $this->kelas)->get();
        $this->resultMateri = $data;

        // Ambil data segment
        foreach($this->resultMateri as $getSegment){
                $getSegment->segmentMateri =  RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                                        ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                                        ->where('kelompok_id', $this->kelas)
                                        ->where('segment_materi', $getSegment->segment_materi)
                                        ->get();
        }
        

        // Ambil data kegiatan untuk setiap materi
        foreach($this->resultMateri as $getMateri){
            $getMateri->getKegiatan = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                                        ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                                        ->where('kelompok_id', $this->kelas)
                                        ->where('materi', $getMateri->materi)->get();
        }

        // Ambil data nilai untuk setiap materi
        foreach ($this->resultMateri as $materi) {
            $materi->nilai = RppmdiniyahNilai::where('rppm_diniyah_id', $materi->id)->get();
        }
    }

    public function loadKelompok()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)
                ->select('idkelas as id', 'kode_kelas')->get();
        $this->kelompok = $data->toArray();
    }

    public function loadDataSiswa()
    {
        $data = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->where('users.campus_id', Auth::user()->campus_id)
                    ->where('rooms.kode_kelas', $this->kelas)->get();
        $this->siswa = $data->toArray();
    }


    public function loadResultFormMateri()
    {
        $data = RppmdiniyahMateri::all();
        $this->resultFormMateri = $data->toArray();
    }

    public function loadResultFormKegiatan()
    {
       $data = RppmdiniyahMaster::where('materi', $this->materi)->get();
       $this->resultFormKegiatan = $data->toArray();
    }

    public function loadCountMateri()
    {
        $data = RppmDiniyah::where('campus_id', Auth::user()->campus_id)->where('semester', $this->semester)
                        ->where('bulan', $this->bulan)->where('pekan', $this->pekan)
                        ->groupBy('materi')
                        ->where('kelompok_id', $this->kelas)->count();
        return $this->countMateri = $data ?? 0;
    }

    public function nilaiBB($id)
    {
        $data = RppmdiniyahNilai::findOrFail($id);
        $data->update(['nilai' => 'BB']);
    }

    public function nilaiMB($id)
    {
        $data = RppmdiniyahNilai::findOrFail($id);
        $data->update(['nilai' => 'MB']);
    }

    public function nilaiBSH($id)
    {
        $data = RppmdiniyahNilai::findOrFail($id);
        $data->update(['nilai' => 'BSH']);
    }

    public function nilaiBSB($id)
    {
        $data = RppmdiniyahNilai::findOrFail($id);
        $data->update(['nilai' => 'BSB']);
    }

    public function confirmDeleteRppm($id)
    {
        $this->idDelete = $id;
        $this->emit('modalConfirmDelete');
    }

    public function deleteRppmDiniyah()
    {
        $kegiatan = RppmDiniyah::findOrFail($this->idDelete);
        $kegiatan->delete();

        $nilai = RppmdiniyahNilai::where('rppm_diniyah_id', $kegiatan->id);
        $nilai->delete();

        $this->emit('closeModalDelete');
    }

}