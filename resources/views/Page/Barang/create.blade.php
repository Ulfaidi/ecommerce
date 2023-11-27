@extends('layouts.main')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <h1>Form Input Kategori</h1>
            <form method="POST" action="{{ url('/barang/store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama Barang:</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok:</label>
                            <input type="number" class="form-control" id="stok" name="stok">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga:</label>
                            <input type="number" step="0.01" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori:</label>
                            <select id="kategori" name="kategori_id" class="form-control">
                                <option value="">-- Pilih Kategori --</option>

                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gambar">Gambar:</label>
                            <input type="file" class="form-control" id="gambar" name="gambar">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>


        </div>
    </div>
@endsection
