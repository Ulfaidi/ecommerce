<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class RegisterController extends Controller
{


    public function daftar()
    {
        return view('login.daftar');
    }

    public function register(Request $request)
    {
        $user = new User;
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->role = 'customer';
        $user->password = bcrypt($request->input('password')); // Anda dapat mengenkripsi password sesuai kebutuhan
        $user->save();


        return redirect()->route('login')->with('success', 'Akun berhasil di buat.');
    }
}
