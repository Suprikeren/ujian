<?php

namespace App\Models;

use App\Models\TblHbeli;
use App\Models\TblBarang;
use Illuminate\Database\Eloquent\Model;

class TblDbeli extends Model
{
    protected $table = 'tbl_dbeli';

    protected $guarded = ['id'];

    public function tblHbeli()
    {
        return $this->belongsTo(TblHbeli::class, 'no_transaksi', 'id');
    }

    public function tblBarang()
    {
        return $this->belongsTo(TblBarang::class, 'kode_barang', 'id');
    }
}
