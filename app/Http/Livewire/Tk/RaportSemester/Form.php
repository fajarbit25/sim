<?php

namespace App\Http\Livewire\Tk\RaportSemester;

use App\Models\Priodik;
use App\Models\RaportTkHafalan;
use App\Models\RaportTKMaster;
use App\Models\RaportTkNarasi;
use App\Models\RaportTkNarasiGambar;
use App\Models\Room;
use App\Models\RppmDiniyah;
use App\Models\RppmdiniyahMaster;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Form extends Component
{
    use WithFileUploads;

    public $loading = false;
    public $check = false;
    public $materiHafalan;
    public $submateri = [];
    public $hafalanSiswa = [];
    public $submateriSelected;
    public $resultSiswa = [];
    public $resultKelas;
    public $countRaport = 0;
    public $namaSiswa;
    public $ta;
    public $taResult = [];
    public $tanggal;
    
    public $kelas;
    public $siswa;
    public $semester;
    public $fase;
    public $tinggi = "";
    public $berat = "";

    public $idNarasi;
    public $segmentUpload;
    public $fileUpload;
    public $agama;
    public $agamaGambar = [];
    public $jatiDiri;
    public $jatiDiriGambar = [];
    public $literasi;
    public $literasiGambar = [];
    public $refleksiGuru;
    public $refleksiGuruGambar;

    public $hafalanSurahLcCount;
    public $hafalanSurahKlCount;
    public $hafalanSurahUlCount;
    public $hafalanHadiztCount;
    public $halafanDoaCount;
    public $hafalanHadist = [];
    public $hafalanHadistLCCount;
    public $hafalanHadistKLCount;
    public $hafalanHadistULCount;
    public $hafalanDoa = [];
    public $hafalanDoaLCCount;
    public $hafalanDoaKLCount;
    public $hafalanDoaULCount;
    
    protected $rules = [
        'fase'          => 'required',
        'agama'         => 'required',
        'jatiDiri'      => 'required',
        'literasi'      => 'required',
        'refleksiGuru'  => 'required',
    ];

    public function render()
    {
        $this->loadData();

        return view('livewire.tk.raport-semester.form', [
            'resultSiswa'       => $this->resultSiswa,
            'resultKelas'       => $this->resultKelas,
            'submateri'         => $this->submateri,
        ]);
    }

    public function loadData()
    {
        $this->check = false;
        $this->getDataKelas();
        $this->getDataSiswa();
        $this->getDataPriodik();
        $this->getAgamaGambar();
        $this->getLiterasiGambar();
        $this->getJatiDiriGambar();
        $this->getRefleksiGuruGambar();
        $this->getCountRaport();
        $this->getNamaSiswa();
        $this->getDataHafalan();
        $this->getDataHafalanAyat();
        $this->getDataHafalanHadist();
        $this->getDataHafalanDoa();
        $this->getHafalanSurahCount();
        $this->getHafalanHadistCount();
        $this->getHafalanDoaCount();
        $this->getDataTahunajaran();
    }

    public function getDataKelas()
    {
        $data = Room::where('campus_id', Auth::user()->campus_id)->get();
        $this->resultKelas = $data->toArray();
    }

    public function getDataSiswa()
    {
        $data = User::where('kelas', $this->kelas)
                    ->select('id', 'first_name as nama')->get();
        $this->resultSiswa = $data->toArray();
    }

    public function getDataPriodik()
    {
        $data = Priodik::where('user_id', $this->siswa)
                        ->orderBy('created_at', 'DESC')->first();
        $this->berat = $data->berat ?? 0;
        $this->tinggi = $data->tinggi ?? 0;
    }

    public function getDataTahunAjaran()
    {
        $data = Semester::orderBy('created_at', 'DESC')->limit(15)->get();
        $this->taResult = $data->toArray();
    }

    public function saveNarasi()
    {
        $this->validate();

        //Cek Data apakah ada atau tidak
        $count =  RaportTkNarasi::where('kelas', $this->kelas)->where('user_id', $this->siswa)
                            ->where('semester', $this->semester)->count();

        if($count == 0){ //jika tidak ada lakukan create

            $data = [
                'user_id'       => $this->siswa,
                'ta'            => $this->ta,
                'tanggal'       => $this->tanggal,
                'semester'      => $this->semester,
                'kelas'         => $this->kelas,
                'fase'          => $this->fase,
                'agama'         => $this->agama,
                'jati_diri'     => $this->jatiDiri,
                'literasi'      => $this->literasi,
                'refleksi_guru' => $this->refleksiGuru,
                'refleksi_orang_tua' => '-',
            ];
            RaportTkNarasi::create($data);
            $this->getDataNarasi();
            $this->emit('notifSuccess');

        }else{ //jika ada lakukan update

            $data = [
                'tanggal'       => $this->tanggal,
                'fase'          => $this->fase,
                'agama'         => $this->agama,
                'jati_diri'     => $this->jatiDiri,
                'literasi'      => $this->literasi,
                'refleksi_guru' => $this->refleksiGuru,
                'refleksi_orang_tua' => '-',
            ];
            $narasi = RaportTkNarasi::find($this->idNarasi);
            $narasi->update($data);
            $this->getDataNarasi();
            $this->emit('notifSuccess');
            
        }
        
    }


    public function getDataNarasi()
    {
        $data = RaportTkNarasi::where('kelas', $this->kelas)->where('user_id', $this->siswa)
                            ->where('ta', $this->ta)->where('semester', $this->semester)->first();
        $this->idNarasi = $data->id ?? '';
        $this->fase = $data->fase ?? '';
        $this->agama = $data->agama ?? '';
        $this->jatiDiri = $data->jati_diri ?? '';
        $this->literasi = $data->literasi ?? '';
        $this->refleksiGuru = $data->refleksi_guru ?? '';
        $this->tanggal = $data->tanggal ?? '';

        
    }

    public function getAgamaGambar()
    {
        $data = RaportTkNarasiGambar::where('id_narasi', $this->idNarasi)->where('segment', 'Agama')->get();
        $this->agamaGambar = $data->toArray();
    }

    public function getJatiDiriGambar()
    {
        $data = RaportTkNarasiGambar::where('id_narasi', $this->idNarasi)->where('segment', 'Jati-Diri')->get();
        $this->jatiDiriGambar = $data->toArray();
    }

    public function getLiterasiGambar()
    {
        $data = RaportTkNarasiGambar::where('id_narasi', $this->idNarasi)->where('segment', 'Literasi')->get();
        $this->literasiGambar = $data->toArray();
    }

    public function getRefleksiGuruGambar()
    {
        $data = RaportTkNarasiGambar::where('id_narasi', $this->idNarasi)->where('segment', 'Refleksi-guru')->get();
        $this->refleksiGuruGambar = $data->toArray();
    }

    public function uploadGambar($segment)
    {
        $this->segmentUpload = $segment;
        $this->emit('modalUploadGambar');
    }

    public function closeModalUpload()
    {
        $this->emit('closeModalUpload');
    }

    public function prosesUploadGambar()
    {
        $this->validate([
            'fileUpload' => 'image|max:5048', // Contoh validasi, maksimal 5MB
        ]);

        /** Save foto */
        $imageName =  bin2hex(random_bytes(25)). '.' . $this->fileUpload->getClientOriginalExtension();
        $path = $this->fileUpload->storeAs('raport-narasi', $imageName, 'public');

        $data = [
            'id_narasi'     => $this->idNarasi,
            'segment'       => $this->segmentUpload,
            'foto'          => $imageName,
        ];

        RaportTkNarasiGambar::create($data);
        $this->closeModalUpload();
        $this->emit('notifSuccess');

    }

    public function deleteGambar($id)
    {
        $gambar = RaportTkNarasiGambar::findOrFail($id);
        $gambar->delete();
        $this->emit('notifSuccess');

    }

    public function getCountRaport()
    {
        $count = RaportTkNarasi::where('kelas', $this->kelas)->where('user_id', $this->siswa)
                            ->where('semester', $this->semester)->count();
        $this->countRaport = $count ?? 0;
    }

    public function getNamaSiswa()
    {
        if($this->siswa){
            $data = User::findOrFail($this->siswa);
            $this->namaSiswa = $data->first_name ?? '';
        }
    }

    public function modalHafalan($id)
    {
        $this->materiHafalan = $id;
        $this->emit('modalHafalan');
    }

    public function getDataHafalan()
    {
        if($this->materiHafalan == 'Tahfidz'){
            $data = RppmdiniyahMaster::where('materi', $this->materiHafalan)
                                    ->select('kegiatan as submateri')->get();
            $this->submateri = $data->toArray();
        }elseif($this->materiHafalan == 'Hadist'){
            $data = RaportTKMaster::where('materi', $this->materiHafalan)->get();
            $this->submateri = $data->toArray();
        }elseif($this->materiHafalan == 'Doa'){
            $data = RaportTKMaster::where('materi', $this->materiHafalan)->get();
            $this->submateri = $data->toArray();
        }
    }

    public function prosesHafalan()
    {
        $this->validate(['submateriSelected' => 'required']);
        RaportTkHafalan::create([
            'id_narasi'     => $this->idNarasi,
            'user_id'       => $this->siswa,
            'materi'        => $this->materiHafalan,
            'kegiatan'      => $this->submateriSelected,
            'nilai'         => '-',
        ]);
    }

    public function closeModalHafalan()
    {
        $this->emit('closeModalHafalan');
    }

    public function getDataHafalanAyat()
    {
        $data = RaportTkHafalan::where('id_narasi', $this->idNarasi)
                                ->where('materi', 'Tahfidz')->get();
        $this->hafalanSiswa = $data->toArray();
    }

    public function getDataHafalanHadist()
    {
        $data = RaportTkHafalan::where('id_narasi', $this->idNarasi)
                                ->where('materi', 'Hadist')->get();
        $this->hafalanHadist = $data->toArray();
    }

    public function getDataHafalanDoa()
    {
        $data = RaportTkHafalan::where('id_narasi', $this->idNarasi)
                                ->where('materi', 'Doa')->get();
        $this->hafalanDoa = $data->toArray();
    }

    public function nilai($id, $value)
    {
        $data = RaportTkHafalan::find($id);
        $data->update([
            'nilai'     => $value,
        ]);
    }

    public function getHafalanSurahCount()
    {
        $LC = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Tahfidz')->where('nilai', 'LC')->count();
        $this->hafalanSurahLcCount = $LC ?? 0;

        $KL = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Tahfidz')->where('nilai', 'KL')->count();
        $this->hafalanSurahKlCount = $KL ?? 0;

        $UL = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Tahfidz')->where('nilai', 'UL')->count();
        $this->hafalanSurahUlCount = $UL ?? 0;
    }

    public function getHafalanHadistCount()
    {
        $LC = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Hadist')->where('nilai', 'LC')->count();
        $this->hafalanHadistLCCount = $LC ?? 0;

        $KL = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Hadist')->where('nilai', 'KL')->count();
        $this->hafalanHadistKLCount = $KL ?? 0;

        $UL = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Hadist')->where('nilai', 'UL')->count();
        $this->hafalanHadistULCount = $UL ?? 0;
    }

    public function getHafalanDoaCount()
    {
        $LC = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Doa')->where('nilai', 'LC')->count();
        $this->hafalanDoaLCCount = $LC ?? 0;

        $KL = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Doa')->where('nilai', 'KL')->count();
        $this->hafalanDoaKLCount = $KL ?? 0;

        $UL = RaportTkHafalan::where('id_narasi', $this->idNarasi)->where('materi', 'Doa')->where('nilai', 'UL')->count();
        $this->hafalanDoaULCount = $UL ?? 0;
    }

    public function deleteNilai($id)
    {
        $data = RaportTkHafalan::find($id);
        $data->delete();
    }

} 