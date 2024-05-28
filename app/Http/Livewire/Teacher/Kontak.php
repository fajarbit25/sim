<?php

namespace App\Http\Livewire\Teacher;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Kontak extends Component
{
    public $isClicked = false;
    public $user_id;
    public $phone;
    public $telephone;
    public $email;


    protected function rules()
    {
        return [
            'phone'     => ['required', 'min:6', 'max:15', Rule::unique('users')->ignore($this->user_id)],
            'telephone' => ['required', 'min:6', 'max:15', Rule::unique('users')->ignore($this->user_id)],
            'email'     => ['required', 'email', Rule::unique('users')->ignore($this->user_id)],
        ];
    }
    

    public function mount($user)
    {
        $this->user_id = $user->id;
        $this->phone = $user->phone;
        $this->telephone = $user->telephone;
        $this->email = $user->email;
    }

    public function updateContactTeacher()
    {
        $this->isClicked = true; //btn animasi

        $validatedData = $this->validate(); //panggil validasi data

        /**update */
        User::where('id', $this->user_id)->update($validatedData);

        session()->flash('message', 'Data Kompetensi diperbaharui!.'); //kirim notifikasi success
    }

    public function render()
    {
        return view('livewire.teacher.kontak');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
