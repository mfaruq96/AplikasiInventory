<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_produk extends Model
{
    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'kode_produk',
        'foto_produk_satu',
        'foto_produk_dua',
        'foto_produk_tiga',
        'tgl_register'
    ];
    protected $primaryKey = 'id_produk';
}
