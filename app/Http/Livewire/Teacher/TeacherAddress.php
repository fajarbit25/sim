<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Alamat;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Http;

class TeacherAddress extends Component
{
    public $isClicked = false;
    public $user_id;

    /**data Result dari API */
    public $provinces;
    public $cities = [];
    public $districts = [];
    public $villages = [];

    /**Isi Form jika tidak null */
    public $provinceActiveName;
    public $cityActiveName;
    public $districtActiveName;
    public $villageActiveName;
    public $provinceActiveId;
    public $cityActiveId;
    public $districtActiveId;
    public $villageActiveId;
    public $dusun;
    public $rt;
    public $rw;
    public $jalan;
    public $lintang;
    public $bujur;
    public $kode_pos;

    /**Isi form dengan kode */
    public $selectedProvince;
    public $selectedCity;
    public $selectedDistrict;
    public $selectedVillage;



    /**Validation */
    protected $rules = [
        'selectedProvince'      => 'required',
        'selectedCity'          => 'required',
        'selectedDistrict'      => 'required',
        'selectedVillage'       => 'required',
        'rt'                    => 'required',
        'rw'                    => 'required',
        'jalan'                 => 'required',
        'kode_pos'              => 'required|min:5',
    ];


    public function updateTeacherAddress()
    {
        $this->isClicked = true; //Animasi button

        $validatedData = $this->validate(); //panggil validasi

        Alamat::where('user_id', $this->user_id)->update([
            'dusun'         => $this->dusun,
            'rt'            => $this->rt,
            'rw'            => $this->rw,
            'jalan'         => $this->jalan,
            'kode_pos'      => $this->kode_pos,
            'lintang'       => $this->lintang,
            'bujur'         => $this->bujur,
        ]);

        session()->flash('message', 'Data alamat diperbaharui!.'); //kirim notifikasi success
    }

    public function mount($address)
    {
        
        $this->provinces = $this->getProvinces();
        $this->user_id = $address->user_id;
        $this->provinceActiveName = $address->provinsi ?? null;
        $this->cityActiveName = $address->kota ?? null;
        $this->districtActiveName = $address->kec ?? null;
        $this->villageActiveName = $address->kel ?? null;
        $this->provinceActiveId = $address->idprovinsi ?? null;
        $this->cityActiveId = $address->idkota ?? null;
        $this->districtActiveId = $address->idkec ?? null;
        $this->villageActiveId = $address->idkel ?? null;

        $this->dusun = $address->dusun ?? null;
        $this->rt = $address->rt ?? null;
        $this->rw = $address->rw ?? null;
        $this->jalan = $address->jalan ?? null;
        $this->lintang = $address->lintang ?? null;
        $this->bujur = $address->bujur ?? null;
        $this->kode_pos = $address->kode_pos ?? null;


    }

    public function getProvinces()
    {
        $response = Http::get('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
        return $response->json();
    }

    public function getCities($provinceId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/".$provinceId.".json");
        return $response->json();
    }

    public function getDistricts($cityId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/districts/".$cityId.".json");
        return $response->json();
    }

    public function getVillages($districtId)
    {
        $response = Http::get("https://www.emsifa.com/api-wilayah-indonesia/api/villages/".$districtId.".json");
        return $response->json();
    }

    public function updatedSelectedProvince($value)
    {
        $this->cities = $this->getCities($value);
        $this->selectedCity = null;
        $this->districts = [];
        $this->selectedDistrict = null;
        $this->villages = [];
        $this->selectedVillage = null;
    }

    public function updatedSelectedCity($value)
    {
        $this->districts = $this->getDistricts($value);
        $this->selectedDistrict = null;
        $this->villages = [];
        $this->selectedVillage = null;
    }

    public function updatedSelectedDistrict($value)
    {
        $this->villages = $this->getVillages($value);
        $this->selectedVillage = null;
    }

    public function render()
    {
        return view('livewire.teacher.teacher-address');
    }

    public function AnimatedButton()
    {
        $this->isClicked = !$this->isClicked;
    }
}
