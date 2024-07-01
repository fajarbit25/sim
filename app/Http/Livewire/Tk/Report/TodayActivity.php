<?php

namespace App\Http\Livewire\Tk\Report;

use App\Models\TkDailyReport;
use Livewire\Component;
use App\Helpers\DateHelper;
use App\Models\TkSubdailyReport;
use Illuminate\Support\Facades\Auth;

class TodayActivity extends Component
{
    public $activity;
    public $image;
    public $today;
    public $dataSub;
    public $countData;

    public function mount()
    {
        $this->getDataActivity();
        $this->getToday();
    }

    public function render()
    {
        return view('livewire.tk.report.today-activity');
    }

    public function getImage($foto)
    {
        $this->image = $foto;
    }

    public function getDataActivity()
    {
        $data = TkDailyReport::where('tanggal', date('Y-m-d'))->where('kelas', Auth::user()->kelas)->first();
        $dataSub  = TkSubdailyReport::where('tanggal_report', date('Y-m-d'))->where('kelas', Auth::user()->kelas)->get();
        $this->dataSub = $dataSub;
        $this->activity = $data;
    }

    public function getToday()
    {
        $dayInEnglish = date('l');
        $dayInIndonesian = DateHelper::hariDalamBahasaIndonesia($dayInEnglish);

        $this->today = $dayInIndonesian;
    }
}
