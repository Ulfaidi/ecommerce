@extends('layouts.app')

@section('content')
    <h1>User</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ url('/user/create') }}" class="btn btn-primary ml-auto">Tambah User</a>
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($users as $user)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $user->nama }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->nomor_telepon }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a onclick="deleteUser({{ $user->id }})" class="btn btn-danger btn-sm">Hapus</a>
                        <a href="{{ url('/user/' . $user->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>
    
                    <!-- Tampilkan kolom lainnya jika ada -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Role</th>
                <th>Nomor Telepon</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function deleteUser(id) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda yakin ingin menghapus user ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih 'Ya, Hapus!'
                    window.location = "{{ url('/user') }}/" + id;
                }
            });
        }

        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Gambar User'
            });
        }
    </script>
@endsection
