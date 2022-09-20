<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tbl_kategori extends Model
{
    protected $fillable = ['nama_kategori'];
    protected $primaryKey = 'id_kategori';
}
