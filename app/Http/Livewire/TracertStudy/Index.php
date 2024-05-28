<?php

namespace App\Http\Livewire\TracertStudy;

use App\Models\TracertStudy;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $start = '2024';
    public $end = '2024';
    public $search;
    protected $queryString = ['search'=> ['except' => '']];
    public $limitPerPage = 10;

    protected $listeners = [
        'searchData' => 'postData',
        'reloadDataTable'   => 'reloadData',
    ];

    public function postData()
    {
        //$this->limitPerPage = $this->limitPerPage + 6;
        $this->limitPerPage = $this->limitPerPage;
    }

    public function reloadData()
    {
        $this->loadData();
    }

    public function render()
    {
        $userData = $this->loadData();

        if($this->search !== null){
            $userData = TracertStudy::join('users', 'users.id', '=', 'tracert_studies.user_id')
            ->join('students', 'students.user_id', '=', 'tracert_studies.user_id')
            ->join('registers', 'registers.user_id', '=', 'tracert_studies.user_id')
            ->join('rooms', 'rooms.idkelas', '=', 'tracert_studies.kelas_terakhir')
            ->where('tracert_studies.campus_id', Auth::user()->campus_id)
            ->where('first_name', 'like', '%'.$this->search.'%')
            ->orWhere('phone', 'like', '%'.$this->search.'%' )
            ->orWhere('nis', 'like', '%'.$this->search.'%' )
            ->orWhere('nisn', 'like', '%'.$this->search.'%' )
            ->select('first_name as name', 'email', 'nis', 'nisn', 'kode_kelas as kelas',
            'phone', 'angkatan', 'nomor_jazah', 'tracert_studies.user_id as id')
            ->paginate($this->limitPerPage);
        }

        // Render view dengan menyertakan data paginasi
        return view('livewire.tracert-study.index', [
            'userData'  => $userData,
        ]);
    }



    public function loadData()
    {
        return TracertStudy::join('users', 'users.id', '=', 'tracert_studies.user_id')
                ->join('students', 'students.user_id', '=', 'tracert_studies.user_id')
                ->join('registers', 'registers.user_id', '=', 'tracert_studies.user_id')
                ->join('rooms', 'rooms.idkelas', '=', 'tracert_studies.kelas_terakhir')
                ->where('tracert_studies.campus_id', Auth::user()->campus_id)
                ->where('angkatan', '>=', $this->start)
                ->where('angkatan', '<=', $this->end)
                ->select('first_name as name', 'email', 'nis', 'nisn', 'kode_kelas as kelas',
                'phone', 'angkatan', 'nomor_jazah', 'tracert_studies.user_id as id')
                ->paginate($this->limitPerPage);
    }


    //Add Ijazah
    public function addIjazah($id)
    {
        $this->emit('addIjazah', $id);
    }

    //Modal Tahun Angkatan
    public function modalTahunAngkatan()
    {
        $this->emit('modalTahunAngkatan');
    }

}
