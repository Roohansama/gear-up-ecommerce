<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function logout(Request $request){
        $response = Http::post('127.0.0.1:8001/api/logout', [
            'token' => session('token'),
        ]);

        if($response->failed()){
            return back()->withErrors($response->json());
        }

        session()->flush();

        return redirect()->to('/login');

    }
    public function login(Request $request){
        $response = Http::post('127.0.0.1:8001/api/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if($response->failed()){
            return back()->withErrors($response->json());
        }

        $token = $response->json()['token'];

        session()->put('token', $token);

        // Decode the token and login user in this app
        JWTAuth::setToken($token);
        $payload = JWTAuth::getPayload();
        $userId = $payload->get('sub'); // usually user ID
        $user = \App\Models\User::find($userId);
        if ($user) {
            Auth::login($user); // this sets Laravel session
        }

        return redirect()->to('/');
    }

}
