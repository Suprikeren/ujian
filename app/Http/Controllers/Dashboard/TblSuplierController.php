<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TblSuplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TblSuplierController extends Controller
{
    public function index(){
        $supliers = TblSuplier::all();
        return view('dashboard.suplier.index', compact('supliers'));
    }
}
