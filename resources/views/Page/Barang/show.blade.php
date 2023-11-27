@extends('layouts.main')
@section('content')
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="mb-4">
                    <a type="button" href="/barang/create" class="btn btn-primary">
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
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $counter = 1;
                                    @endphp
                                    @foreach ($barangs as $barang)
                                        <tr>
                                            <td>{{ $counter++ }}</td>
                                            <td>{{ $barang->nama }}</td>
                                            <td>
                                                @if ($barang->gambar)
                                                    <button type="button" class="btn btn-info btn-sm"
                                                        onclick="showImage('{{ asset('storage/gambar/' . $barang->gambar) }}')">Cek
                                                        Gambar</button>
                                                @else
                                                    Tidak Ada Gambar
                                                @endif
                                            </td>
                                            <td>{{ $barang->stok }}</td>
                                            <td>{{ $barang->harga }}</td>
                                            <td>
                                                <a onclick="deleteBarang({{ $barang->id }})"
                                                    class="btn btn-danger btn-sm">Hapus</a>
                                                <a href="{{ url('/barang/' . $barang->id . '/edit') }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                            </td>

                                            <!-- Tampilkan kolom lainnya jika ada -->
                                        </tr>
                                    @endforeach
                                </tbody>ss
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Gambar</th>
                                        <th>Stok</th>
                                        <th>Harga</th>
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
        function deleteBarang(id) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda yakin ingin menghapus barang ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih 'Ya, Hapus!'
                    window.location = "{{ url('/barang') }}/" + id;
                }
            });
        }

        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Gambar Barang'
            });
        }
    </script>
@endsection
