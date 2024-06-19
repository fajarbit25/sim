<?php

namespace App\Http\Livewire\Ortu;

use App\Models\SdNilaiPelajaran;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChartStatistik extends Component
{
    public $chartData;

    public function mount()
    {
        $this->chartData = [
            'labels' => ['2024-06-14', '2024-07-14', '2024-07-28', '2024-07-30', '2024-08-07'],
            'datasets' => [
                [
                    'label' => 'Surah',
                    'data' => [1, 5, 8, 8, 9],
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


