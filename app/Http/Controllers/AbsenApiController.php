<?php

namespace App\Http\Controllers;

use App\Models\AbsenApi;
use App\Models\TagAbsen;
use App\Models\User;
use Illuminate\Http\Request;

class AbsenApiController extends Controller
{
    public function absenGet()
    {
        return response()->json([
            'status'    => true,
            'message'   => 'Connected...'
        ], 200);
    }

    public function post(Request $request)
    {
        $rules = [
            'rfid'     => 'required',
        ];

        $dataUser = User::where('rfid', $request->rfid)->first();//Load Data user by Rfid

        if(!$dataUser){

            $cekTagAbsen = TagAbsen::where('tag_absen', 0)->first(); //Load Tag Absen By Data User

            if($cekTagAbsen){
                $userId = $cekTagAbsen->user_id;
                $user = User::findOrFail($userId);
                $user->update(['rfid' => $request->rfid]);
                return response()->json([
                    'status'    => true,
                    'message'   => 'Kartu didaftarkan!',
                ], 201);
            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => 'Kartu tidak terdaftar!',
                ], 400);
            }
            
        }

        
        $cek = AbsenApi::where('user_id', $dataUser->id)
                ->where('tanggal', date('Y-m-d'))->count();//cek kartu di table database

        if($cek != 0){
            $loadMasuk = AbsenApi::where('user_id', $dataUser->id)
                        ->where('tanggal', date('Y-m-d'))->first();
            
            if($loadMasuk->jam_pulang == '-'){

                $jamMasuk = $loadMasuk->jam_masuk;
                $jamSekrangan = date('H:i');

                $detik_masuk = strtotime($jamMasuk);
                $detik_pulang = strtotime($jamSekrangan);

                // Selisih waktu antara jam pulang dan jam masuk dalam detik
                $selisih_detik = $detik_pulang - $detik_masuk;

                
                // Konversi selisih waktu kembali ke format menit
                $menit_selisih = ($selisih_detik % 3600) / 60;

                if($menit_selisih >= 15){
                    AbsenApi::where('user_id', $dataUser->id)
                        ->where('tanggal', date('Y-m-d'))
                        ->update(['jam_pulang' => date('H:i')]);
                    return response()->json([
                        'status'    => true,
                        'message'   => 'Absen Pulang Success!',
                    ], 202);
                }else{
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Anda telah absen hari ini!',
                    ], 403);
                }
                

            }else{
                return response()->json([
                    'status'    => false,
                    'message'   => 'Anda telah absen hari ini!',
                ], 403);
            }
        }

        AbsenApi::create([
            'campus_id'     => $dataUser->campus_id,
            'user_id'       => $dataUser->id,
            'tanggal'       => date('Y-m-d'),
            'tipe'          => 'IN',
            'jam_masuk'     => date('H:i'),
            'jam_pulang'    => '-',
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Absensi Berhasil!',
        ], 200);
 
    }
}
