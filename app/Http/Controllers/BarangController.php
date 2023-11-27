<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator; // Tambahkan ini di atas namespace jika belum ada


class BarangController extends Controller
{
    public function show()
    {

        $barangs = Barang::all(); // Ambil semua data barang dari model Barang
        return view('Page.Barang.show')->with('barangs', $barangs);
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('Page.Barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // Validasi gambar
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Nama file unik

            // Simpan file di direktori public/gambar
            $file->storeAs('gambar', $fileName, 'public');

            // Simpan data ke dalam database
            Barang::create([
                'nama' => $validatedData['nama'],
                'stok' => $validatedData['stok'],
                'harga' => $validatedData['harga'],
                'kategori_id' => $validatedData['kategori_id'],
                'gambar' => $fileName // Simpan nama file di dalam kolom gambar
            ]);

            Alert::success('Sukses!', 'Barang berhasil disimpan.');
        } else {
            Alert::error('Gagal!', 'Gambar tidak ditemukan.');
        }

        return redirect('/barang');
    }


    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'Barang berhasil dihapus.');

        // Redirect ke halaman show barang
        return redirect('/barang');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategoris = Kategori::all();
        return view('Page.Barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048' // sesuaikan dengan kebutuhan
        ]);

        $barang = Barang::findOrFail($id);

        // Update data
        $barang->nama = $validatedData['nama'];
        $barang->stok = $validatedData['stok'];
        $barang->harga = $validatedData['harga'];
        $barang->kategori_id = $validatedData['kategori_id'];

        // Hapus gambar lama jika ada
        if ($barang->gambar) {
            Storage::disk('public')->delete('gambar/' . $barang->gambar);
        }

        // Jika gambar baru diunggah, proses gambar
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('gambar', $fileName, 'public');
            // Simpan nama file ke database atau proses lainnya
            $barang->gambar = $fileName;
        }

        $barang->save();

        Alert::success('Sukses!', 'Barang berhasil diperbarui!');

        return redirect('/barang');
    }
}
