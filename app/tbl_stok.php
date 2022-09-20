<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_stok extends Model
{
    protected $fillable = [
        'id_produk',
        'jumlah_barang',
        'tgl_register'
    ];
    protected $primaryKey = 'id_stok';
}
