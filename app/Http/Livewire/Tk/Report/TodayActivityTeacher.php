<?php

namespace App\Http\Livewire\Tk\Report;

use App\Models\Room;
use App\Models\TkDailyReport;
use App\Models\TkSubdailyReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class TodayActivityTeacher extends Component
{
    use WithFileUploads;
    public $loading = false;
    public $check = 0;
    public $notif;
    public $mode;

    public $topik;
    public $subtopik;
    public $menghafal;
    public $menulis;
    public $murojaah;
    public $sentra;
    public $subsentra;
    public $inggris;
    public $bahasa;
    public $arab;
    public $kelas;
    public $kegiatan;
    public $photo;

    public $dataKelas;
    public $dataKegiatan;
    public $dataFoto;

    public $history;
    public $detailHistory;
    public $subRaportKegiatan;
    public $subRaportFoto;


    protected $rules = [
        'topik'         => 'required',
        'subtopik'      => 'required',
        'menghafal'     => 'required',
        'menulis'       => 'required',
        'murojaah'      => 'required',
        'sentra'        => 'required',
        'subsentra'     => 'required',
        'inggris'       => 'required',
        'bahasa'        => 'required',
        'arab'          => 'required',
        'kelas'         => 'required',
    ];

    public function mount()
    {
        $this->getDataReport();
        $this->getDataKelas();
        $this->mode = 1;
        $this->getDataFoto();
        $this->getHistoryKegiatan();
    }

    public function loadAll()
    {
        $this->getDataReport();
        $this->getDataKelas();
        $this->getDataKegiatan();
        $this->getDataFoto();
        $this->getHistoryKegiatan();
    }

    public function render()
    {
        return view('livewire.tk.report.today-activity-teacher');
    }

    public function getDataKelas()
    {
        $kelas = Room::where('campus_id', Auth::user()->campus_id)->select('idkelas', 'tingkat', 'kode_kelas')->get();
        $this->dataKelas = $kelas;
    }

    public function getDataReport()
    {
        $report = TkDailyReport::where('tanggal', date('Y-m-d'))->where('kelas', $this->kelas)->first();
        $this->topik    = $report->topik ?? "";
        $this->subtopik = $report->subtopik ?? "";
        $this->menghafal    = $report->menghafal ?? "";
        $this->menulis  = $report->menulis ?? "";
        $this->murojaah = $report->murojaah ?? "";
        $this->sentra   = $report->sentra ?? "";
        $this->subsentra    = $report->subsentra ?? "";
        $this->inggris  = $report->inggris ?? "";
        $this->bahasa  = $report->bahasa ?? "";
        $this->arab = $report->arab ?? "";
    }

    public function simpanReport()
    {
        $this->validate();
        $data = [
            'topik'         => $this->topik,
            'subtopik'      => $this->subtopik,
            'menghafal'     => $this->menghafal,
            'menulis'       => $this->menulis,
            'murojaah'      => $this->murojaah,
            'sentra'        => $this->sentra,
            'subsentra'     => $this->subsentra,
            'inggris'       => $this->inggris,
            'bahasa'        => $this->bahasa,
            'arab'          => $this->arab,
            'kelas'         => $this->kelas,
            'updated_by'    => Auth::user()->id,
            'tanggal'       => date('Y-m-d'),
        ];
        TkDailyReport::create($data);
        $this->getDataReport();
        $this->check = 0;
        $this->notif = [
            'status'    => 200,
            'message'   => 'Data Laporan Diperbaharui!',
        ];
        $this->showAlert();
    }

    public function modalKegiatan()
    {
        $this->emit('modalKegiatan');
    }

    public function saveKegiatan()
    {
        $this->validate(['kegiatan' => 'required']);
        TkSubdailyReport::create([
            'kelas'             => $this->kelas,
            'tanggal_report'    => date('Y-m-d'),
            'tipe'              => 'kegiatan',
            'deskripsi'         => $this->kegiatan,
            'updated_by'        => Auth::user()->id,
        ]);
        $this->getDataKegiatan();
        $this->kegiatan = "";
        $this->emit('closeModal');
    }

    public function removeKegiatan($id)
    {
        $data = TkSubdailyReport::findOrFail($id);
        $data->delete();
        $this->getDataKegiatan();
    }

    public function getDataKegiatan()
    {
        $data = TkSubdailyReport::where('kelas', $this->kelas)->where('tipe', 'kegiatan')
                    ->where('tanggal_report', date('Y-m-d'))->select('id', 'deskripsi')->get();
        $this->dataKegiatan = $data;
    }

    public function getDataFoto()
    {
        $data = TkSubdailyReport::where('kelas', $this->kelas)->where('tipe', 'foto')
            ->where('tanggal_report', date('Y-m-d'))->select('id', 'foto')->get();
        $this->dataFoto = $data;
    }

    public function deletePhoto($id)
    {
        $photo = TkSubdailyReport::findOrFail($id);
        $photo->delete();
        $this->getDataFoto();
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // validasi untuk gambar maksimal 1MB
        ]);
    }

    public function savePhoto()
    {
        $this->validate([
            'photo' => 'image|max:5124', // validasi untuk gambar maksimal 5MB
        ]);


        $filename   = $this->photo->getClientOriginalName();
        $this->photo->storeAs('public/tk-daily', $filename);

        TkSubdailyReport::create([
            'kelas'             => $this->kelas,
            'tanggal_report'    => date('Y-m-d'),
            'tipe'              => 'foto',
            'deskripsi'         => 'foto-kegiatan',
            'updated_by'        => Auth::user()->id,
            'foto'              => $filename,
        ]);

        $this->reset('photo'); // reset field photo setelah berhasil diupload
        $this->mode = 1;
        $this->getDataFoto();
    }

    public function getHistoryKegiatan()
    {
        $data = TkDailyReport::join('rooms', 'rooms.idkelas', '=', 'tk_daily_reports.kelas')
                ->get();
        $this->history = $data;
    }

    public function detailHistory($id)
    {
        $raport = TkDailyReport::findOrfail($id);
        $subRaportKegiatan = TkSubdailyReport::where('tanggal_report', $raport->tanggal)->where('tipe', 'kegiatan')->get();
        $subRaportFoto = TkSubdailyReport::where('tanggal_report', $raport->tanggal)->where('tipe', 'foto')->get();
        $this->detailHistory = $raport;
        $this->subRaportKegiatan = $subRaportKegiatan;
        $this->subRaportFoto = $subRaportFoto;
        $this->emit('openModalHistory');
        $this->getHistoryKegiatan();
    }

    public function showAlert()
    {
        // Panggil JavaScript untuk menampilkan popup SweatAlert
        $this->emit('showAlert', [
            'type' => $this->notif['status'],
            'message' => $this->notif['message'],
        ]);
    }
}

