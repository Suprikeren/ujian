<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TblDbeli;
use App\Models\TblHbeli;
use App\Models\TblStock;
use App\Models\TblBarang;
use App\Models\TblSuplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $barangs = TblBarang::count();
        $supliers = TblSuplier::count();
        $stock = TblStock::count();
        $pembelian = TblHbeli::count();
        $detail_pembelian = TblDbeli::count();
        return view('dashboard.index', [
            'barangs' => $barangs,
            'supliers' => $supliers,
            'stock' => $stock,
            'pembelian' => $pembelian,
            'detail_pembelian' => $detail_pembelian,
        ]);
    }
}
