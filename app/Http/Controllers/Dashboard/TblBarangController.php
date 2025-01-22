<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TblBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TblBarangController extends Controller
{
    public function index(){
        $barangs = TblBarang::all();
        return view('dashboard.barang.index', compact('barangs'));
    }
}
