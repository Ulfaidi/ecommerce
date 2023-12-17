<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class CustomerController extends Controller
{
    public function show()
    {
        $customers = Customer::all(); // Ambil semua data customer dari model Customer
        return view('Admin.Customer.show')->with('customers', $customers);
    }

    public function destroy($id)
    {
        // Temukan entri Customer berdasarkan ID
        $customer = Customer::findOrFail($id);

        // Temukan pengguna terkait dengan entri Customer
        $user = $customer->user;

        // Hapus entri Customer
        $customer->delete();

        // Jika terdapat pengguna terkait, hapus juga dari tabel users
        if ($user) {
            $user->delete();
        }

        // Tampilkan SweetAlert
        Alert::success('Sukses!', 'Customer berhasil dihapus.');

        // Redirect ke halaman show customer
        return redirect('/customer');
    }
}
