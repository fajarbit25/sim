<?php

namespace App\Http\Controllers;
use App\Models\News;
use App\Models\Banner;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\File;

class NewsController extends Controller
{
    public function index():View
    {
        $data = [
            'title'     => 'News',
            'news'      => News::join('users', 'users.id', '=', 'user_id')
                            ->where('user_id', Auth::user()->id)->get(),
        ];
        return view('news.index', $data);
    }
    public function addNews():view
    {
        $check = News::where('user_id', Auth::user()->id)->where('posted', 0)->count();
        if($check == 0){
            $dataTemp = [
                'poster'      => 'news-1.jpg',
                'judul'       => '',
                'berita'      => '',
                'user_id'     => Auth::user()->id,
                'posted'      => 0,
                'post_date'   => date('Y-m-d'),
            ];
            News::create($dataTemp);
        }

        $data = [
            'title'     => 'Create News',
            'news'      => News::where('user_id', Auth::user()->id)->where('posted', 0)->first(),
        ];
        return View('news.editor', $data);
    }

    public function loadValue()
    {
        $value = News::where('user_id', Auth::user()->id)->where('posted', 0)->first();
        echo json_encode($value);
    }

    public function loadValue_edit($id)
    {
        $value = News::where('user_id', Auth::user()->id)->where('idnews', $id)->first();
        echo json_encode($value);
    }

    public function update(Request $request)
    {
        $idnews = $request->idnews;
        $data = [
            'judul'       => $request->judul,
            'berita'      => $request->berita,
        ];
        News::where('idnews', $idnews)->update($data);
    }

    public function loadImage():view
    {
        $data = [
            'news'  => News::where('user_id', Auth::user()->id)->where('posted', 0)->first(),
        ];
        return View('news.image', $data);
    }

    public function loadImageEdit($id):view
    {
        $data = [
            'news'  => News::where('idnews', $id)->first(),
        ];
        return View('news.image_edit', $data);
    }

    public function uploadImage(Request $request)
    {
        $photo      = $request->file('photo');
        $ekstensi   = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path       = 'photo-news/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data = [
            'poster'    => $filename,
        ];

        News::where('user_id', Auth::user()->id)->where('idnews', $request->idnews)->update($data);
    }

    public function uploadImageNew(Request $request)
    {
        $photo      = $request->file('photo');
        $ekstensi   = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path       = 'photo-news/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data = [
            'poster'    => $filename,
        ];

        News::where('user_id', Auth::user()->id)->where('posted', 0)->update($data);
    }

    public function posts(Request $request):RedirectResponse
    {
        $idnews = $request->idnews;
        News::where('user_id', Auth::user()->id)->where('idnews', $idnews)->update(['posted'=> 1]);
        return redirect('/berita')->with(['success' => 'Posting berita Berhasil']);
    }

    public function takeDown(Request $request):RedirectResponse
    {
        $idnews = $request->idnews;
        News::where('user_id', Auth::user()->id)->where('idnews', $idnews)->update(['posted'=> 0]);
        return redirect('/berita')->with(['success' => 'Berita telah ditarik, publik tidak akan melihat ini!']);
    }

    public function edit(Request $request) : RedirectResponse
    {
        $idnews = $request->idnews;
        News::where('user_id', Auth::user()->id)->where('idnews', $idnews)->update(['posted'=> 0]);
        return redirect('/addNews');
    }

    public function edit_berita($id):view
    {
        $data = [
            'title'     => 'Create News',
            'news'      => News::where('idnews', $id)->first(),
        ];
        return View('news.edit', $data);
    }

    //Banner
    public function store_banner(Request $request)
    {
        $request->validate([
            'foto'  => 'required|image',
        ]);

        $photo      = $request->file('foto');
        $ekstensi   = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename   = date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path       = 'home-banner/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($photo));

        $data = [
            'campus_id'     => Auth::user()->campus_id,
            'foto'          => $filename,
            'updated_by'     => Auth::user()->id,
            'keterangan'    => $request->keterangan,
        ];
        Banner::create($data);
    }

    public function update_banner():view
    {
        $idcampus = Auth::user()->campus_id;
        $data = [
            'title'     => 'Update Banner',
            'banner'    => Banner::where('campus_id', $idcampus)->get(),
        ];
        return view('news.banner', $data);
    }

    public function bannerCarousel():view
    {
        $data = [
            'banner'    => Banner::where('banners.campus_id', Auth::user()->campus_id)
                            ->join('users', 'users.id', '=', 'banners.updated_by')
                            ->orderBy('idbanner', 'ASC')->get(),
        ];
        return view('news.carousel', $data);
    }

    public function tableBanner():view
    {
        $data = [
            'banner'    => Banner::where('banners.campus_id', Auth::user()->campus_id)->join('users', 'users.id', '=', 'banners.updated_by')->get(),
        ];
        return view('news.table-banner', $data);
    }

    public function deleteBanner(Request $request)
    {
        $request->validate(['idbanner'  => 'required']);
        Banner::where('idbanner', $request->idbanner)->delete();
        return response(['success' => 'Your file has been deleted']);
    }

    /** Our Team */
    public function tim():view
    {
        $data = [
            'title'     => 'Our Team',
            'team'      => Team::where('campus_id', Auth::user()->campus_id)->get(),
        ];
        return view('news.tim', $data);
    }
    public function tim_add():view
    {
        $data = [
            'title'     => 'Create New Team',
        ];
        return view('news.tim_add', $data);
    }
    public function tim_add_store(Request $request)
    {
        Validator::validate($request->all(), [
            'foto'    => [
                'required',
                File::types(['img', 'jpeg', 'jpg', 'png'])->max(20000),
            ],
            'nama'      => 'required',
            'jabatan'   => 'required',
            'twitter'   => 'required',
            'fb'        => 'required',
            'ig'        => 'required',
            'linked'    => 'required',
        ]);

        $photo = $request->file('foto');
        $ekstensi = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename = 'team'.date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path = 'our-tim/'.$filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        $data = [
            'nama'          => $request->nama,
            'jabatan'       => $request->jabatan,
            'foto'          => $filename,
            'twitter'       => $request->twitter,
            'fb'            => $request->fb,
            'ig'            => $request->ig,
            'linked'        => $request->linked,
            'campus_id'     => Auth::user()->campus_id,
        ];
        Team::create($data);
        return response(['success' => 'Data Berhasil Disimpan!']);
    }
    public function tim_edit($id):view
    {
        $data = [
            'title'     => 'Edit Team',
            'tim'       => Team::where('idteam', $id)->first(),
        ];
        return view('news.tim_edit', $data);
    }
    public function tim_foto($id):View
    {
        $data = [
            'tim'       => Team::where('idteam', $id)->first(),
        ];
        return view('news.tim_foto', $data);
    }
    public function tim_update(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required',
            'jabatan'   => 'required',
            'twitter'   => 'required',
            'fb'        => 'required',
            'ig'        => 'required',
            'linked'    => 'required',
        ]);

        $idteam = $request->idteam;
        Team::where('idteam', $idteam)->update($validated);
        return response(['success' => 'Updated!']);

    }
    public function tim_destroy(Request $request)
    {
        $request->validate([
            'idteam'    => 'required',
        ]);
        Team::where('idteam', $request->idteam)->delete();
        return response(['success' => 'Deleted!']);
    }
    public function tim_update_foto(Request $request)
    {
        Validator::validate($request->all(), [
            'foto'    => [
                'required',
                File::types(['img', 'jpeg', 'jpg', 'png'])->max(20000),
            ],
            'idteam'      => 'required',
        ]);

        $photo = $request->file('foto');
        $ekstensi = $photo->getClientOriginalExtension();
        $randomName = rand(1111, 9999);
        $filename = 'team'.date('Ymdhis').'-'.$randomName.".".$ekstensi;
        $path = 'our-tim/'.$filename;

        Storage::disk('public')->put($path, file_get_contents($photo));

        Team::where('idteam', $request->idteam)->update(['foto' => $filename]);
        return response(['success' => 'Image Updated!']);
    }

}
