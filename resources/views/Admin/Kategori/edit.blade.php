@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kategori</h2>
        <form action="{{ url('/kategori', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
