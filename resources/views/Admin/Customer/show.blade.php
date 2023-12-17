@extends('layouts.app')

@section('content')
    <h1>Customer</h1>

    <table id="example" class="table table-striped table-bordered nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($customers as $customer)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $customer->user->nama }}</td>
                    <td>{{ $customer->user->nomor_telepon }}</td>
                    <td>{{ $customer->user->email }}</td>
                    <td>{{ $customer->alamat }}</td>
                    <td>
                        <a onclick="deleteCustomer({{ $customer->id }})" class="btn btn-danger btn-sm">Hapus</a>
                    </td>

                    <!-- Tampilkan kolom lainnya jika ada -->
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nomor</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function deleteCustomer(id) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda yakin ingin menghapus customer ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna memilih 'Ya, Hapus!'
                    window.location = "{{ url('/customer') }}/" + id;
                }
            });
        }

        function showImage(imageUrl) {
            Swal.fire({
                imageUrl: imageUrl,
                imageAlt: 'Gambar Customer'
            });
        }
    </script>
@endsection
