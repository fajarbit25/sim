<?php

namespace App\Http\Controllers;

use App\Models\Apitoken;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthTokenController extends Controller
{
    public function loginUser(Request $request)
    {
        $rules = [
            'email'     => 'required|email',
            'password'  => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return response()->json([
                'status'    => false,
                'message'   => 'Auth Error!',
                'data'      => $validator->errors()
            ], 401);
        }


        if(!Auth::attempt($request->only('email', 'password'))){
            return response()->json([
                'status'    => false,
                'message'   => 'Auth Fails',
            ], 401);
        }

        $dataUser = User::where('email', $request->email)->first();

        //Save Token
        Apitoken::create([
            'token'     => $dataUser->createToken('api-sims')->plainTextToken,
            'keterangan'=> 'Token API-'.$request->email,
            'user_id'   => $dataUser->id,
        ]);

        return response()->json([
            'status'    => true,
            'message'   => 'Login Success',
            'token'     => $dataUser->createToken('api-sims')->plainTextToken,
        ]);

    }
}

//token admins@iqis.sch.id
//1|pW2MIobN4YPA2NosXFQtAHXlYs5TI1iQiLBYYvtGf176b049
//3|mPw7TECLNHED9O7ypXeLTsQdqfZ0LEI0AALyMRwaf7392ec1