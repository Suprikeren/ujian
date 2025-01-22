<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TblStock;
use App\Models\TblBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TblStockController extends Controller
{
    public function index(){
        $stocks = TblStock::all();
        $barang = TblBarang::all();
        return view('dashboard.stock.index', compact('stocks','barang'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|exists:tbl_barang,id',
            'qty' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // jangan biarkan data duplicate
        $existingStock = TblStock::where('kode_barang', $request->kode_barang)->first();

        if ($existingStock) {
            return response()->json([
                'success' => false,
                'message' => 'Kode Barang sudah ada. Silahkan lakukan update.',
            ], 400);
        }
        //

        $post = TblStock::create([
            'kode_barang' => $request->kode_barang,
            'qty' => $request->qty,
        ]);

        $kode_barang = $post->barang->kode_barang;

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Disimpan!',
            'data' => [
                'id' => $post->id,
                'kode_barang' => $kode_barang,
                'qty' => $post->qty,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required|exists:tbl_barang,id',
            'qty' => 'integer|required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $post = TblStock::find($id);

        $existingStock = TblStock::where('kode_barang', $request->kode_barang)
                                  ->where('id', '!=', $id)
                                  ->first();

        if ($existingStock) {
            return response()->json([
                'success' => false,
                'message' => 'Kode Barang sudah ada. Silahkan cari kode barang lain.',
            ], 400);
        }

        $post->update([
            'kode_barang' => $request->kode_barang,
            'qty' => $request->qty,
        ]);

        $kode_barang = $post->barang->kode_barang;

        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diupdate!',
            'data' => [
                'id' => $post->id,
                'kode_barang' => $kode_barang,
                'qty' => $post->qty,
            ]
        ]);
    }

    public function destroy($id)
{
    $stock = TblStock::find($id);

    if ($stock) {
        $stock->delete();
        return response()->json(['success' => true]);
    }

    return response()->json(['success' => false]);
}

}
