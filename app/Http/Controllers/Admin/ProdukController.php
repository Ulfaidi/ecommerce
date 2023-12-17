<?php


namespace App\Http\Controllers\Admin;

use App\Models\Produk;
use App\Models\Kategori;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        $gambarDetail = [];
        $thumbnailPath = null;

        // Upload gambar_detail
        if ($files = $request->file('gambar_detail')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_fullname = $image_name . '.' . $ext;
                $upload_path = 'uploads/gambar/';
                $image_url = $upload_path . $image_fullname;
                $file->move($upload_path, $image_fullname);
                $gambarDetail[] = $image_url;
            }
        }

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = md5(rand(1000, 10000)) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('uploads/gambar/', $thumbnailName);
            $thumbnailPath = 'uploads/gambar/' . $thumbnailName;
        }

        // Simpan data ke database
        Produk::create([
            'gambar_detail' => implode('|', $gambarDetail),
            'thumbnail' => $thumbnailPath,
            'nama' => $request->nama,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'kategori_id' => $request->kategori_id
        ]);

        Alert::success('Sukses!', 'Produk berhasil disimpan.');

        return redirect('/produk');
    }



    public function destroy($id)
    {
        // Ambil data produk berdasarkan ID
        $produk = Produk::find($id);

        // Hapus file gambar_detail
        $gambarDetail = explode('|', $produk->gambar_detail);
        foreach ($gambarDetail as $gambar) {
            if (file_exists(public_path($gambar))) {
                unlink(public_path($gambar));
            }
        }

        // Hapus file thumbnail
        if (file_exists(public_path($produk->thumbnail))) {
            unlink(public_path($produk->thumbnail));
        }

        // Hapus record produk dari database
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
        $produk = Produk::find($id);

        // Hapus file gambar_detail lama
        if ($request->hasFile('thumbnail')) {
            if (file_exists(public_path($produk->thumbnail))) {
                unlink(public_path($produk->thumbnail));
            }
        }

        // Hapus file thumbnail lama
        if ($request->hasFile('gambar_detail')) {
            $gambarDetail = explode('|', $produk->gambar_detail);
            foreach ($gambarDetail as $gambar) {
                if (file_exists(public_path($gambar))) {
                    unlink(public_path($gambar));
                }
            }
        }

        // Upload gambar_detail baru
        $gambarDetail = [];
        if ($files = $request->file('gambar_detail')) {
            foreach ($files as $file) {
                $image_name = md5(rand(1000, 10000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_fullname = $image_name . '.' . $ext;
                $upload_path = 'uploads/gambar/';
                $image_url = $upload_path . $image_fullname;
                $file->move($upload_path, $image_fullname);
                $gambarDetail[] = $image_url;
            }
        }

        // Upload thumbnail baru
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = md5(rand(1000, 10000)) . '.' . $thumbnail->getClientOriginalExtension();
            $thumbnail->move('uploads/gambar/', $thumbnailName);
            $thumbnailPath = 'uploads/gambar/' . $thumbnailName;

            // Simpan data ke database
            $produk->update([
                'gambar_detail' => implode('|', $gambarDetail),
                'thumbnail' => $thumbnailPath,
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga' => $request->harga,
                'kategori_id' => $request->kategori_id
            ]);

            Alert::success('Sukses!', 'Produk berhasil diperbarui.');

            return redirect('/produk');
        }

        Alert::error('Gagal!', 'Gagal mengupload gambar.');

        return back();
    }
}
