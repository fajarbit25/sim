<?php

namespace App\Http\Controllers;

use App\Models\Apitoken;
use App\Models\Attendance;
use App\Models\TracertStudy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    public function getDataTracertStudy(Request $request, $sekolah, $nisn, $tanggal_lahir) //Get Data Tracert Study
    {
        //Cek Token Api
        if (!$request->bearerToken()) {
            return response()->json([
                'status' => false,
                'message' => 'Anda tidak memiliki akses. Silakan hubungi developer untuk mendapatkan token.',
            ], 401);
        }

       $data = TracertStudy::join('users', 'users.id', '=', 'tracert_studies.user_id')
       ->join('students', 'students.user_id', '=', 'tracert_studies.user_id')
       ->join('registers', 'registers.user_id', '=', 'tracert_studies.user_id')
       ->join('rooms', 'rooms.idkelas', '=', 'tracert_studies.kelas_terakhir')
       ->where('tracert_studies.campus_id', $sekolah)->where('users.kelas', 'Tamat')
       ->where('students.nisn', $nisn)->where('tanggal_lahir', $tanggal_lahir)
       ->select('first_name as name', 'email', 'nis', 'nisn', 'kode_kelas as kelas', 'tanggal_lahir',
       'phone', 'angkatan', 'nomor_jazah', 'skhu', 'tracert_studies.user_id as id')
       ->first();

       if(!$data){
            return response()->json([
                'status' => false,
                'message' => 'Data Tidak Ditemukan',
            ], 404);
       }

       return response()->json([
        'status'    => true,
        'message'   => 'Data ditemukan',
        'data'      => $data,
       ], 200);
    }
}
