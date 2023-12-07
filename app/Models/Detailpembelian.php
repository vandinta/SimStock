<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detailpembelian extends Model
{
    use HasFactory;

    protected $table = 'tbl_dbeli';

    protected $fillable = [
        'notransaksi',
        'kodebrg',
        'hargabeli',
        'qty',
        'diskon',
        'diskonrp',
        'totalrp',
    ];
}
