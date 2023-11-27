@extends('layouts.main')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <h1>Form Input Kategori</h1>

        <form method="POST" action="{{ url('/kategori/store') }}" class="mt-4">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Kategori:</label>
                <input type="text" id="nama" name="nama" class="form-control">
            </div>
        
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
