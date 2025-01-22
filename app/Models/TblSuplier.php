<?php

namespace App\Models;

use App\Models\TblHbeli;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TblSuplier extends Model
{
    protected $table = 'tbl_suplier';

    protected $guarded = ['id'];

    public function hbeli(): HasMany
    {
        return $this->hasMany(TblHbeli::class, 'kode_suplier', 'id');
    }


}
