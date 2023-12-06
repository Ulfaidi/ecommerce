<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function show()
    {
        $barangData = Barang::all();

        //// Kirim data ke view
        return view('Web.main', compact('barangData'));    
    }
}
