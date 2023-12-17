<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{


    public function daftar()
    {
        return view('login.daftar');
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed|regex:/[0-9]/',
            'nomor_telepon' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'alamat' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect('daftar')
                ->withErrors($validator)
                ->withInput();
        } 

        // Simpan data ke tabel "users"
        $user = new User;
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role = 'customer'; // Jika ingin secara otomatis role customer
        $user->nomor_telepon = $request->input('nomor_telepon');
        $user->email = $request->input('email');
        $user->save();

        // Simpan data ke tabel "customers"
        $customer = new Customer;
        $customer->user_id = $user->id;
        $customer->alamat = $request->input('alamat');
        // Jika ada kolom lain di tabel "customers" yang perlu diisi, tambahkan disini
        $customer->save();

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat.');
    }
}
