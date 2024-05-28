<?php

namespace App\Http\Controllers;

use App\Models\TracertStudy;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TracertStudyController extends Controller
{
    

    public function index()
    {
        $campusId = Auth::user()->campus_id;
        $data = [
            'title'     => 'Tracert Study',
            'result'    => TracertStudy::join('users', 'users.id', '=', 'tracert_studies.user_id')
                                        ->join('students', 'students.user_id', '=', 'tracert_studies.user_id')
                                        ->join('registers', 'registers.user_id', '=', 'tracert_studies.user_id')
                                        ->where('tracert_studies.campus_id', $campusId)
                                        ->select('first_name', 'email', 'nis', 'nisn', 'phone')
                                        ->paginate(1),
        ];
        return view('tracert-study.index', $data);
    }
}
