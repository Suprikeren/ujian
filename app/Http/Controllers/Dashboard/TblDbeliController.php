<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\TblDbeli;
use App\Models\TblHbeli;
use App\Models\TblBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TblDbeliController extends Controller
{
    public function index(){
        $dbelis = TblDbeli::all();
        $barang = TblBarang::all();
        $transaksis = TblHbeli::all();
        return view('dashboard.detail_pembelian.index', compact('dbelis','barang','transaksis'));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'no_transaksi' => 'required|exists:tbl_hbeli,id',
            'kode_barang' => 'required|exists:tbl_barang,id',
            'qty' => 'required|integer|min:1',
            'diskon' => 'required|integer|min:0|max:100',
        ]);

        $barang = TblBarang::find($validated['kode_barang']);

        $totalrp = $validated['qty'] * $barang->harga_beli;

        $diskonrp = ($totalrp * $validated['diskon']) / 100;

        $totalrp_after_discount = $totalrp - $diskonrp;

        $pembelian = TblDbeli::create([
            'no_transaksi' => $validated['no_transaksi'],
            'kode_barang' => $validated['kode_barang'],
            'qty' => $validated['qty'],
            'diskon' => $validated['diskon'],
            'diskon_rp' => $diskonrp,
            'total_rp' => $totalrp_after_discount,
        ]);

        return response()->json([
            'message' => 'Data pembelian berhasil disimpan',
            'data' => $pembelian
        ]);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'no_transaksi' => 'required|exists:tbl_hbeli,id',
            'kode_barang' => 'required|exists:tbl_barang,id',
            'qty' => 'required|integer|min:1',
            'diskon' => 'required|integer|min:0|max:100',
        ]);

        $barang = TblBarang::find($validated['kode_barang']);
        $totalrp = $validated['qty'] * $barang->harga_beli;
        $diskonrp = ($totalrp * $validated['diskon']) / 100;

        $totalrp_after_discount = $totalrp - $diskonrp;

        $pembelian = TblDbeli::findOrFail($id);
        $pembelian->update([
            'no_transaksi' => $validated['no_transaksi'],
            'kode_barang' => $validated['kode_barang'],
            'qty' => $validated['qty'],
            'diskon' => $validated['diskon'],
            'diskon_rp' => $diskonrp,
            'total_rp' => $totalrp_after_discount,
        ]);

        return response()->json([
            'message' => 'Data pembelian berhasil disimpan',
            'data' => $pembelian
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
