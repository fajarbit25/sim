<?php

namespace App\Http\Livewire\TeacherAttendance;

use App\Models\AbsenApi;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    public $isClicked = false;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['reloadData'];
    public $limitPerPage = 10;
    public $mulai;
    public $sampai;



    public function mount()
    {
        $this->reloadData();
        $this->mulai = date('Y-m-d');
        $this->sampai = date('Y-m-d');
    }

    public function render()
    {
        $result = $this->loadData();
        return view('livewire.teacher-attendance.data', [
            'result'    => $result,
        ]);
    }

    public function reloadData()
    {
        $this->loadData();
    }

    public function loadData()
    {
        return AbsenApi::join('users', 'users.id', '=', 'absen_apis.user_id')
                    ->join('kepegawaian_teachers', 'kepegawaian_teachers.user_id', '=', 'absen_apis.user_id')
                    ->where('absen_apis.campus_id', Auth::user()->campus_id)
                    ->whereBetween('tanggal', [$this->mulai, $this->sampai])
                    ->select('first_name as name', 'nip', 'level', 'jam_masuk', 'jam_pulang')
                    ->paginate($this->limitPerPage);
    }

    //Modal Filter
    public function modalFilter()
    {
        $this->emit('openModalFilter');
    }

    //Button Animaso
    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }

}
