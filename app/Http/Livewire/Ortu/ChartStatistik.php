<?php

namespace App\Http\Livewire\Ortu;

use App\Models\SdNilaiPelajaran;
use App\Models\TahfidzNilai;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChartStatistik extends Component
{
    public $chartData;

    public function mount()
    {
        $loadData = TahfidzNilai::join('tahfidz_surahs', 'tahfidz_surahs.id', '=', 'tahfidz_nilais.id_surah')
                    ->where('tahfidz_nilais.user_id', Auth::user()->id)
                    ->select('nilai', 'arab')
                    ->get();

        // Prepare data and labels for the chart
        $data = [];
        $labels = [];
        
        foreach ($loadData as $dataPoint) {
            $data[] = $dataPoint->nilai;
            $labels[] = $dataPoint->arab;
        }



        $this->chartData = [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Surah',
                    'data' => $data,
                    'backgroundColor' => ['rgba(75, 192, 192, 0.2)'],
                    'borderColor' => ['rgba(75, 192, 192, 1)'],
                    'borderWidth' => 1
                ]
            ]
        ];
    }

    public function render()
    {
        return view('livewire.ortu.chart-statistik');
    }
}


