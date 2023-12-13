@extends('layouts.app')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h1>Form Edit Produk</h1>
            <form method="POST" action="{{ url('/produk/' . $produk->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama">Nama Produk:</label>
                            <input type="text" id="nama" name="nama" class="form-control"
                                value="{{ $produk->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok:</label>
                            <input type="number" id="stok" name="stok" class="form-control"
                                value="{{ $produk->stok }}">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="number" step="0.01" id="harga" name="harga" class="form-control"
                                value="{{ $produk->harga }}">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <select id="kategori" name="kategori_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}"
                                        {{ $produk->kategori_id == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">


                        <div class="form-group">
                            <label for="thumbnail">Thumbnail:</label>
                            <input type="file" id="thumbnail" name="thumbnail" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="gambar_detail1">Gambar_detail1:</label>
                            <input type="file" id="gambar_detail1" name="gambar_detail1" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="gambar_detail2">Gambar_detail2:</label>
                            <input type="file" id="gambar_detail2" name="gambar_detail2" class="form-control-file">
                        </div>
                        <div class="form-group">
                            <label for="gambar_detail3">Gambar_detail3:</label>
                            <input type="file" id="gambar_detail3" name="gambar_detail3" class="form-control-file">
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection
