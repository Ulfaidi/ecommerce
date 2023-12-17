@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Customer</h2>
        <form action="{{ url('/customer', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" class="form-control" value="{{ $customer->nama }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
