<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class UserController extends Controller
{
    public function show()
    {
        $users = User::all(); // Ambil semua data user dari model User
        return view('Admin.User.show')->with('users', $users);
    }

    public function create()
    {
        return view('Admin.User.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:255',
            'username' => 'required|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required',
            'nomor_telepon' => 'nullable',
            'email' => 'nullable',
            'alamat' => 'nullable', // Ditambahkan untuk alamat
        ]);

        // Buat instance baru dari model User
        $user = new User([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'nomor_telepon' => $request->nomor_telepon,
            'email' => $request->email,
        ]);

        // Simpan user ke tabel users
        $user->save();

        // Jika peran pengguna adalah 'customer', simpan ke tabel customers juga
        if ($request->role === 'customer') {
            $customer = new Customer([
                'photo' => $request->photo,
                'alamat' => $request->alamat,
            ]);

            // Simpan customer ke tabel customers dan hubungkan dengan user
            $user->customer()->save($customer);
        }

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'User berhasil ditambahkan!');

        // Redirect ke halaman show user
        return redirect('/user');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('Admin.User.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
         $request->validate([
        'nama' => 'required|max:255',
        'username' => 'required|unique:users,username,' . $id,
        'password' => '',
        'role' => 'required',
        'nomor_telepon' => 'nullable',
        'email' => 'nullable',
        'alamat' => 'nullable', // Ditambahkan untuk alamat
        ]);

        $user = User::findOrFail($id);

        // Simpan nilai peran pengguna sebelum diubah
        $oldRole = $user->role;

        // Update data pengguna
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->email = $request->email;
        $user->save();

        // Periksa perubahan peran pengguna
        if ($oldRole !== $request->role) {
            // Jika peran pengguna berubah, lakukan tindakan sesuai perubahan
            if ($oldRole === 'customer') {
                // Jika awalnya customer, hapus entri di tabel customers
                $user->customer()->delete();
            } elseif ($request->role === 'customer') {
                // Jika peran pengguna menjadi customer, buat dan simpan entri di tabel customers
                $customer = new Customer([
                    'photo' => $request->photo,
                    'alamat' => $request->alamat,
                ]);
                $user->customer()->save($customer);
            }
        }

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'User berhasil diperbarui!');

        // Redirect ke halaman show user
        return redirect('/user');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Periksa apakah pengguna memiliki entri di tabel Customer
        $customer = Customer::where('user_id', $user->id)->first();

        if ($customer) {
            // Hapus entri di tabel Customer terlebih dahulu
            $customer->delete();
        }

        // Hapus pengguna
        $user->delete();

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'User berhasil dihapus.');

        // Redirect ke halaman show user
        return redirect('/user');
    }
}
