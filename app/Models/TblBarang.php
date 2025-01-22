<?php

namespace App\Models;

use App\Models\TblDbeli;
use App\Models\TblStock;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TblBarang extends Model
{
    protected $table = 'tbl_barang';

    protected $guarded = ['id'];

    public function stock(): HasOne
    {
        return $this->hasOne(TblStock::class, 'kode_barang', 'id');
    }
    public function tblDbeli()
    {
        return $this->hasMany(TblDbeli::class, 'kode_barang', 'id');
    }
}
