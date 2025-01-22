<?php

namespace App\Models;

use App\Models\TblDbeli;
use App\Models\TblSuplier;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TblHbeli extends Model
{
    protected $table = 'tbl_hbeli';

    protected $guarded = ['id'];



    public function suplier(): BelongsTo
    {
        return $this->belongsTo(TblSuplier::class, 'kode_suplier', 'id');
    }
    public function tblDbeli()
    {
        return $this->hasMany(TblDbeli::class, 'no_transaksi', 'id');
    }

}
