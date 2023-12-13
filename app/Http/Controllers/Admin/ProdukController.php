<?php


namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Kategori;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function show()
    {

        $produks = Produk::all(); // Ambil semua data produk dari model Produk
        return view('Admin.Produk.show')->with('produks', $produks);
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('Admin.Produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'nama' => $validatedData['nama'],
            'stok' => $validatedData['stok'],
            'harga' => $validatedData['harga'],
            'kategori_id' => $validatedData['kategori_id'],
        ];

        // Cek dan simpan thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnailFileName = time() . '_thumb_' . $thumbnailFile->getClientOriginalName();
            $thumbnailFile->storeAs('gambar', $thumbnailFileName, 'public');
            $data['thumbnail'] = $thumbnailFileName;
        }

        // Cek dan simpan gambar detail 1 jika ada
        if ($request->hasFile('gambar_detail1')) {
            $gambarDetail1File = $request->file('gambar_detail1');
            $gambarDetail1FileName = time() . '_detail1_' . $gambarDetail1File->getClientOriginalName();
            $gambarDetail1File->storeAs('gambar', $gambarDetail1FileName, 'public');
            $data['gambar_detail1'] = $gambarDetail1FileName;
        }

        // Cek dan simpan gambar detail 2 jika ada
        if ($request->hasFile('gambar_detail2')) {
            $gambarDetail2File = $request->file('gambar_detail2');
            $gambarDetail2FileName = time() . '_detail2_' . $gambarDetail2File->getClientOriginalName();
            $gambarDetail2File->storeAs('gambar', $gambarDetail2FileName, 'public');
            $data['gambar_detail2'] = $gambarDetail2FileName;
        }

        // Cek dan simpan gambar detail 3 jika ada
        if ($request->hasFile('gambar_detail3')) {
            $gambarDetail3File = $request->file('gambar_detail3');
            $gambarDetail3FileName = time() . '_detail3_' . $gambarDetail3File->getClientOriginalName();
            $gambarDetail3File->storeAs('gambar', $gambarDetail3FileName, 'public');
            $data['gambar_detail3'] = $gambarDetail3FileName;
        }

        // Simpan data ke dalam database
        Produk::create($data);

        Alert::success('Sukses!', 'Produk berhasil disimpan.');

        return redirect('/produk');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'Produk berhasil dihapus.');

        // Redirect ke halaman show produk
        return redirect('/produk');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('Admin.Produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input form
        $validatedData = $request->validate([
            'nama' => 'required|max:255',
            'stok' => 'required|numeric',
            'harga' => 'required|numeric',
            'kategori_id' => 'required|exists:kategori,id',
            'thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail1' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail2' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'gambar_detail3' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $produk = Produk::findOrFail($id);

        // Update data
        $produk->nama = $validatedData['nama'];
        $produk->stok = $validatedData['stok'];
        $produk->harga = $validatedData['harga'];
        $produk->kategori_id = $validatedData['kategori_id'];

        // Hapus gambar lama jika ada
        if ($produk->thumbnail) {
            Storage::disk('public')->delete('thumbnail/' . $produk->thumbnail);
        }

        // Simpan thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $this->uploadImage($request->file('thumbnail'));
        }

        // Simpan gambar detail 1
        if ($request->hasFile('gambar_detail1')) {
            $data['gambar_detail1'] = $this->uploadImage($request->file('gambar_detail1'));
        }

        // Simpan gambar detail 2
        if ($request->hasFile('gambar_detail2')) {
            $data['gambar_detail2'] = $this->uploadImage($request->file('gambar_detail2'));
        }

        // Simpan gambar detail 3
        if ($request->hasFile('gambar_detail3')) {
            $data['gambar_detail3'] = $this->uploadImage($request->file('gambar_detail3'));
        }

        $produk->save();

        Alert::success('Sukses!', 'Produk berhasil diperbarui!');

        return redirect('/produk');
    }
}
