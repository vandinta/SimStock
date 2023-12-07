<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'tbl_hbeli';

    protected $fillable = [
        'notransaksi',
        'kodespl',
        'tgl_beli',
    ];
}
