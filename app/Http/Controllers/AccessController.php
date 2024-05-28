<?php

namespace App\Http\Controllers;

use App\Models\Confirmpayment;
use App\Models\Ppdb;
use App\Models\Register;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Student;
use App\Models\Room;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AccessController extends Controller
{
    public function showsiswa($id):view
    {
            $data = [
                'title'     => 'Informasi Siswa',
                'siswa'     => User::where('id', $id)
                                        ->join('levels', 'levels.idlevel', '=', 'users.level')
                                        ->join('rooms', 'rooms.idkelas', '=', 'users.kelas')
                                        ->first(),
                'student'   => Student::join('users', 'users.id', '=', 'students.user_id')->where('user_id', $id)->first(),
            ];
            return view('siswa.acc_show', $data);
    }

    /**Notif Finance */
    public function finNotifJson()
    {
        $data = [
            'countData' => Confirmpayment::where('campus_id', Auth::user()->campus_id)
                            ->where('confirm_status', 0)->count(),
            'userLevel' => Auth::user()->level,
        ];

        return response()->json($data);
    }

    public function ppdbNotifJson()
    {
        /**
         * Load Data register agar ketahuan 
         * user telah menyelesaikan pendaftaran atau belum.
         */

        $data = [
            'countData' => Ppdb::join('users', 'users.id', '=', 'ppdbs.user_id')
                                    ->where('users.campus_id', Auth::user()->campus_id)
                                    ->where('level', '4')
                                    ->where('ppdbs.status', '1')->count(),
        ];
        return response()->json($data);
    }
}
