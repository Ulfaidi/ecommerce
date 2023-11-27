@extends('layouts.main')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h1>Edit Kategori</h1>

        <form method="POST" action="{{ url('/kategori/'.$kategori->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama Kategori:</label>
                <input type="text" id="nama" name="nama" value="{{ $kategori->nama }}" class="form-control">
            </div>
        
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
