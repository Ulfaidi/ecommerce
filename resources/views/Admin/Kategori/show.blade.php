@extends('layouts.app')

@section('content')
    <h1>Kategori</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ url('/kategori/create') }}" class="btn btn-primary ml-auto">Tambah Kategori</a>
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($kategoris as $kategori)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $kategori->nama }}</td>
                    <td>
                        <a onclick="deleteKategori({{ $kategori->id }})" class="btn btn-danger btn-sm">Hapus</a>
                        <a href="{{ url('/kategori/' . $kategori->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>

                    <!-- Tampilkan kolom lainnya jika ada -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function deleteKategori(id) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda yakin ingin menghapus kategori ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih 'Ya, Hapus!'
                    window.location = "{{ url('/kategori') }}/" + id;
                }
            });
        }

        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Gambar Kategori'
            });
        }
    </script>
@endsection
