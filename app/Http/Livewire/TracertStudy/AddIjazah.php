<?php

namespace App\Http\Livewire\TracertStudy;

use App\Models\TracertStudy;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AddIjazah extends Component
{
    protected $listeners = ['addIjazah' => 'loadData'];

    public $isClicked = false;

    public $userId;
    public $ijazah;
    public $skhu;

    protected function rules()
    {
        return [
            'ijazah' => ['required', Rule::unique('tracert_studies', 'nomor_jazah')->ignore($this->userId, 'user_id')],
            'skhu'   => ['required', Rule::unique('tracert_studies')->ignore($this->userId, 'user_id')],
        ];
    }

    public function loadData($id)
    {
        $this->userId = $id;
        $this->getData();
    }

    public function getData()
    {
        $data = TracertStudy::where('user_id', $this->userId)->first();
        $this->ijazah = $data->nomor_jazah;
        $this->skhu = $data->skhu;
    }

    public function render()
    {
        return view('livewire.tracert-study.add-ijazah');
    }

    public function updateTracertStudy()
    {
        $isClicked = true;

        $this->validate();

        TracertStudy::where('user_id', $this->userId)->update([
            'nomor_jazah'   => $this->ijazah,
            'skhu'          => $this->skhu,
        ]);

        $this->closeModalIjazah();
        $this->emit('reloadDataTable');
        session()->flash('message', 'Edit data berhasil!'); //kirim notifikasi update
    }

    public function closeModalIjazah()
    {
        $this->emit('closeModalAddIjazah');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
