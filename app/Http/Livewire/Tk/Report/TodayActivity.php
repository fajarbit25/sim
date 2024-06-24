<?php

namespace App\Http\Livewire\Tk\Report;

use App\Models\TkDailyReport;
use Livewire\Component;
use App\Helpers\DateHelper;

class TodayActivity extends Component
{
    public $activity;
    public $image;
    public $today;
    public $countData;

    public function mount()
    {
        $this->getDataActivity();
        if($this->countData != 0){
            $this->getImage();
            $this->getToday();
        }
    }

    public function render()
    {
        return view('livewire.tk.report.today-activity');
    }

    public function getImage()
    {
        $data = TkDailyReport::where('tanggal', date('Y-m-d'))->select('foto')->first();
        $this->image = $data->foto;
    }

    public function getDataActivity()
    {
        $data = TkDailyReport::leftJoin('tk_subdaily_reports', 'tk_subdaily_reports.id_daily_report', 'tk_daily_reports.id')
                        ->where('tanggal', date('Y-m-d'))->get();
        $this->activity = $data;
        $this->countData = $data->count();

    }

    public function getToday()
    {
        $dayInEnglish = date('l');
        $dayInIndonesian = DateHelper::hariDalamBahasaIndonesia($dayInEnglish);

        $this->today = $dayInIndonesian;
    }
}
