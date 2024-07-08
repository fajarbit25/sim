<?php

namespace App\Http\Controllers;

use App\Models\Apitoken;
use App\Models\Attendance;
use App\Models\TracertStudy;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TwilioService;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    protected $twilio;

    public function __construct(TwilioService $twilio)
    {
        $this->twilio = $twilio;
    }

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

    public function sendMessage(Request $request)
    {
        $request->validate([
            'to' => 'required|string',
            'message' => 'required|string',
        ]);

        $to = $this->formatPhoneNumber($request->input('to'));
        $message = $request->input('message');

        $this->twilio->sendWhatsAppMessage($to, $message);

        return response()->json(['status' => 'Message sent successfully']);
    }

    private function formatPhoneNumber($number)
    {
        // Hapus semua karakter non-digit
        $number = preg_replace('/[^0-9]/', '', $number);

        // Tambahkan kode negara jika tidak ada
        if (substr($number, 0, 1) === '0') {
            $number = '62' . substr($number, 1); // Mengubah 0895330078691 menjadi 62895330078691
        }

        return 'whatsapp:+' . $number;
    }
}
