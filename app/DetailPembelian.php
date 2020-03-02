<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
     protected $table = 'detail_pembelian';
     public function pembelian(){
    	return $this->belongsTo('App\Pembelian','id_pembelian');
    }

     public function barang(){
    	return $this->belongsTo('App\Barang','id_barang');
    }
}
