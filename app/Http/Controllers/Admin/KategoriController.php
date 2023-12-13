<?php

namespace App\Http\Controllers\Admin;

use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class KategoriController extends Controller
{
    public function show()
    {
        $kategoris = Kategori::all(); // Ambil semua data kategori dari model Kategori
        return view('Admin.Kategori.show')->with('kategoris', $kategoris);
    }
    public function create()
    {
        return view('Admin.Kategori.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
        ]);

        Kategori::create([
            'nama' => $validatedData['nama'],
        ]);

        Alert::success('Sukses!', 'Kategori berhasil ditambahkan!');

        return redirect('/kategori');
    }
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('Admin.Kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
        ]);

        $kategori = Kategori::find($id);
        $kategori->nama = $validatedData['nama'];
        $kategori->save();

        Alert::success('Sukses!', 'Kategori berhasil diperbarui!');

        return redirect('/kategori');
    }
    public function destroy($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kategori->delete();

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'Kategori berhasil dihapus.');

        // Redirect ke halaman show kategori

        return redirect('/kategori');
    }
}
