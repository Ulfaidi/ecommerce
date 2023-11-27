@extends('layouts.main')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h1>Form Edit Barang</h1>
            <form method="POST" action="{{ url('/barang/' . $barang->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="nama">Nama Barang:</label>
                    <input type="text" id="nama" name="nama" class="form-control" value="{{ $barang->nama }}">
                </div>
                <div class="form-group">
                    <label for="stok">Stok:</label>
                    <input type="number" id="stok" name="stok" class="form-control" value="{{ $barang->stok }}">
                </div>
                <div class="form-group">
                    <label for="harga">Harga:</label>
                    <input type="number" step="0.01" id="harga" name="harga" class="form-control"
                        value="{{ $barang->harga }}">
                </div>
                <div class="form-group">
                    <label for="kategori">Kategori:</label>
                    <select id="kategori" name="kategori_id" class="form-control">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ $barang->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="gambar">Gambar:</label>
                    <input type="file" id="gambar" name="gambar" class="form-control-file">
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
