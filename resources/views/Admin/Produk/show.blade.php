@extends('layouts.app')

@section('content')
    <h1>Produk</h1>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ url('/produk/create') }}" class="btn btn-primary ml-auto">Tambah Produk</a>
    </div>

    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Thumbnail</th>
                <th>Detail1</th>
                <th>Detail2</th>
                <th>Detail3</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($produks as $produk)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $produk->nama }}</td>
                    <td>
                        @if ($produk->gambar)
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="showImage('{{ asset('public/gambar/' . $produk->gambar) }}')">Cek
                                Gambar</button>
                        @else
                            Kosong
                        @endif
                    </td>
                    <td>
                        @if ($produk->thumbnail)
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="showImage('{{ asset('public/gambar/' . $produk->thumbnail) }}')">Cek
                            </button>
                        @else
                            Kosong
                        @endif
                    </td>
                    <td>
                        @if ($produk->gambar_detail1)
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="showImage('{{ asset('public/gambar/' . $produk->gambar_detail1) }}')">Cek
                            </button>
                        @else
                            Kosong
                        @endif
                    </td>
                    <td>
                        @if ($produk->gambar_detail2)
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="showImage('{{ asset('public/gambar/' . $produk->gambar_detail2) }}')">Cek
                            </button>
                        @else
                            Kosong
                        @endif
                    </td>
                    <td>
                        @if ($produk->gambar_detail3)
                            <button type="button" class="btn btn-info btn-sm"
                                onclick="showImage('{{ asset('public/gambar/' . $produk->gambar_detail3) }}')">Cek
                            </button>
                        @else
                            Kosong
                        @endif
                    </td>
                    <td>{{ $produk->stok }}</td>
                    <td>{{ $produk->harga }}</td>
                    <td>
                        <a onclick="deleteProduk({{ $produk->id }})" class="btn btn-danger btn-sm">Hapus</a>
                        <a href="{{ url('/produk/' . $produk->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                    </td>

                    <!-- Tampilkan kolom lainnya jika ada -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Thumbnail</th>
                <th>Detail1</th>
                <th>Detail2</th>
                <th>Detail3</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function deleteProduk(id) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda yakin ingin menghapus produk ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih 'Ya, Hapus!'
                    window.location = "{{ url('/produk') }}/" + id;
                }
            });
        }

        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Gambar Produk'
            });
        }
    </script>
@endsection
