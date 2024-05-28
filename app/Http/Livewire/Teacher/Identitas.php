<?php
namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Identitas extends Component
{
    public $isClicked = false;

    public $userId;
    public $nama;
    public $nik;
    public $jenis_kelamin;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $ibu_kandung;

    protected $rules = [
        'nama'          => 'required|min:3',
        'nik'           => 'required|min:16',
        'jenis_kelamin' => 'required',
        'tempat_lahir'  => 'required',
        'tanggal_lahir' => 'required',
        'ibu_kandung'   => 'required|min:3',
    ];

    public function mount($user)
    {
       $this->userId        = $user->id; 
       $this->nama          = $user->first_name;
       $this->nik           = $user->nik;
       $this->jenis_kelamin = $user->jenis_kelamin;
       $this->tempat_lahir  = $user->tempat_lahir;
       $this->tanggal_lahir = $user->tanggal_lahir;
       $this->ibu_kandung   = $user->ibu_kandung;

    }

    public function render()
    {
        return view('livewire.teacher.identitas');
    }

    public function UpdateTeacher()
    {
        $this->isClicked = true; //Animasi button

        $validatedData = $this->validate();

        User::where('id', $this->userId)->update([
            'first_name'    => $this->nama,
        ]);

        Teacher::where('user_id', $this->userId)->update([
            'jenis_kelamin'     => $this->jenis_kelamin,
            'tempat_lahir'      => $this->tempat_lahir,
            'tanggal_lahir'     => $this->tanggal_lahir,
            'ibu_kandung'       => $this->ibu_kandung,
            'nik'               => $this->nik,
        ]);


        session()->flash('message', 'Data tenaga pendidik diperbaharui!.'); //kirim notifikasi success
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }

}
