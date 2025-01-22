<?php

namespace App\Models;

use App\Models\TblBarang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TblStock extends Model
{
    protected $table = 'tbl_stock';

    protected $guarded = ['id'];

    public function barang(): BelongsTo
    {
        return $this->belongsTo(TblBarang::class, 'kode_barang', 'id');
    }
}
