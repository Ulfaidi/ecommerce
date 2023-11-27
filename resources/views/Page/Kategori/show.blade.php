@extends('layouts.main')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="mb-4">
                    <a type="button" href="/kategori/create" class="btn btn-primary">
                        Tambah
                    </a>
                </div>
                <div class="col-md-12 grid-margin">
                    <div class="row">
                        <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                            <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
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
                                                <a href="{{ url('/kategori/' . $kategori->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <a
                                                    onclick="deleteKategori({{ $kategori->id }})"class="btn btn-danger btn-sm">Hapus</a>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kategori</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    </script>
@endsection
