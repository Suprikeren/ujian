<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TblHbeli;
use App\Models\TblSuplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TblHbeliController extends Controller
{
    public function index(){
        $pembelians = TblHbeli::all();
        $supliers = TblSuplier::all();
        return view('dashboard.daftar_pembelian.index', compact('pembelians','supliers'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_transaksi' => 'required|string|unique:tbl_hbeli,no_transaksi',
            'kode_suplier' => 'required|exists:tbl_suplier,id',
            'tanggal_beli' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = TblHbeli::create([
            'no_transaksi' => $request->no_transaksi,
            'kode_suplier' => $request->kode_suplier,
            'tanggal_beli' => $request->tanggal_beli,
        ]);

        $kode_suplier = $post->suplier->kode_suplier;

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => [
                'id' => $post->id,
                'no_transaksi' => $request->no_transaksi,
                'kode_suplier' => $kode_suplier,
                'tanggal_beli' => $post->tanggal_beli,
            ]
        ]);
    }
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_transaksi' => 'required|string|unique:tbl_hbeli,no_transaksi',
            'kode_suplier' => 'required|exists:tbl_suplier,id',
            'tanggal_beli' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $post = TblHbeli::findOrFail($id);

        $post->update([
            'no_transaksi' => $request->no_transaksi,
            'kode_suplier' => $request->kode_suplier,
            'tanggal_beli' => $request->tanggal_beli,
        ]);

        $kode_suplier = $post->suplier->kode_suplier;

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => [
                'id' => $post->id,
                'no_transaksi' => $request->no_transaksi,
                'kode_suplier' => $kode_suplier,
                'tanggal_beli' => $post->tanggal_beli,
            ]
        ]);
    }

    public function destroy($id)
    {
        $stock = TblHbeli::find($id);

        if ($stock) {
            $stock->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
