@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Kategori</h2>
        <form action="{{ url('/kategori/store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
 