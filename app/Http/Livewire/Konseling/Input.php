<?php

namespace App\Http\Livewire\Konseling;

use App\Models\Campu;
use App\Models\Konseling;
use App\Models\KonselingPoint;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Input extends Component
{
    use WithFileUploads;
    public $notif;
    public $loading;
    public $campus;
    public $userId;
    public $siswa;
    public $nis;
    public $gender;
    public $kelas;
    public $idkelas;
    public $pelanggaran;
    public $idpelanggaran;
    public $keterangan;
    public $foto;

    public $keysiswa;
    public $dataSiswa;
    public $keypelanggaran;
    public $dataPelanggaran;

    public $dataCampus;


    public function mount()
    {
        $this->getDataCampus();
    }
    public function render()
    {
        return view('livewire.konseling.input');
    }

    public function getDataCampus()
    {
        if(Auth::user()->campus_id == '1'){
            $data = Campu::all();
        }else{
            $data = Campu::where('idcampus', Auth::user()->campus_id)->get();
        }
        $this->dataCampus = $data;
    }

    public function modalSiswa()
    {
        $this->getDataSiswa();
        $this->emit('modalSiswa');
    }

    public function modalPelanggaran()
    {
        $this->getDataPelanggaran();
        $this->emit('modalPelanggaran');
    }

    public function getDataSiswa()
    {
        $data = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('users.campus_id', $this->campus)
                    ->select('users.id', 'tingkat', 'kode_kelas', 'nis', 'first_name', 'gender')
                    ->orderBy('rooms.tingkat', 'ASC')->get();
        $this->dataSiswa = $data;
    }

    public function updatedKeysiswa()
    {
        $this->dataSiswa = "";
        $data = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('users.campus_id', $this->campus)
                    ->where('first_name', 'like', '%'.$this->keysiswa.'%')
                    ->select('users.id', 'tingkat', 'kode_kelas', 'nis', 'first_name', 'gender')
                    ->orderBy('rooms.tingkat', 'ASC')->get();
        $this->dataSiswa = $data;
    }

    public function getDataPelanggaran()
    {
        $data = KonselingPoint::where('campus_id', $this->campus)->orderBy('kode', 'ASC')->get();
        $this->dataPelanggaran = $data;
    }

    public function updatedKeypelanggaran()
    {
        $data = KonselingPoint::where('campus_id', $this->campus)
                ->where('pelanggaran', 'like', '%'.$this->keypelanggaran.'%')
                ->orderBy('kode', 'ASC')->get();
        $this->dataPelanggaran = $data;
    }

    public function addSiswa($id)
    {
        $data = User::join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                    ->join('registers', 'registers.user_id', '=', 'users.id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('users.campus_id', $this->campus)
                    ->where('users.id', $id)
                    ->select('users.id', 'tingkat', 'kode_kelas', 'nis', 'first_name', 'gender', 'rooms.idkelas')
                    ->first();
        $this->siswa = $data->first_name;
        $this->nis = $data->nis;
        $this->gender = $data->gender;
        $this->kelas = $data->tingkat.' '.$data->kode_kelas;
        $this->userId = $data->id;
        $this->idkelas = $data->idkelas;

        $this->emit('closeModal');
        $this->keysiswa = "";    
    }

    public function addPelanggaran($id)
    {
        $this->idpelanggaran = $id;
        $data = KonselingPoint::findOrFail($this->idpelanggaran);
        $this->pelanggaran = $data->pelanggaran;

        $this->keypelanggaran = "";
        $this->emit('closeModal');
    }

    public function saveData()
    {
        $this->validate([
            'foto'          => 'required|image|max:5125', // 1MB Max
            'siswa'         => 'required',
            'pelanggaran'   => 'required',
            'keterangan'    => 'required',
        ]);

        $randomName = Str::random(40) . '.' . $this->foto->getClientOriginalExtension();
        $path = $this->foto->storeAs('konseling', $randomName, 'public');

        /**Load data semester active */
        $semester = Semester::where('is_active', 'true')->first();

        $data = [
            'campus_id'     => $this->campus,
            'ta'            => $semester->tahun_ajaran,
            'semester'      => $semester->semester_kode,
            'kelas'         => $this->idkelas,
            'user_id'       => $this->userId,
            'pelanggaran_id'=> $this->idpelanggaran,
            'ket'           => $this->keterangan,
            'foto'          => $randomName,
            'created_by'    => Auth::user()->id,
        ];

        Konseling::create($data);

        $this->resetForm();

        $this->notif = [
            'status'    => 200,
            'message'   => 'Data ditambahkan!',
        ];
        $this->emit('closeModal');
        $this->showAlert();

    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }

    public function resetForm()
    {
        $this->campus = "";
        $this->userId = "";
        $this->siswa = "";
        $this->nis = "";
        $this->gender = "";
        $this->kelas = "";
        $this->idkelas = "";
        $this->pelanggaran = "";
        $this->idpelanggaran = "";
        $this->keterangan = "";
        $this->foto = "";
    }
}
