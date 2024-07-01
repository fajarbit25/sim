<?php

namespace App\Http\Livewire\Siswa;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TableSiswa extends Component
{
    public $loading = false;
    public $campus;
    public $kelas;
    public $cari;
    public $dataSiswa;

    public function mount()
    {
        $this->campus = Auth::user()->campus_id;
    }
    public function loadAll()
    {
        $this->getDataSiswa();
    }

    public function render()
    {
        $this->loadAll();
        return view('livewire.siswa.table-siswa');
    }

    public function getDataSiswa()
    {
            $dataAll = User::where('users.level', 4)
            ->where('users.status', 1)
            ->where('users.campus_id', $this->campus)
            ->join('students', 'students.user_id', '=', 'users.id')
            ->leftJoin('rooms', 'rooms.idkelas', '=', 'users.kelas')
            ->join('registers', 'registers.user_id', '=', 'users.id')
            ->select('first_name', 'nis', 'nisn', 'tingkat', 'kode_kelas', 'gender', 'email', 'phone', 'id', 'users.campus_id', 'idkelas')
            ->get();
            $this->dataSiswa = $dataAll;

    }

}
