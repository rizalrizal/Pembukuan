<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
     public function penjualan(){
    	return $this->belongsTo('App\Penjualan','id_penjualan');
    }

     public function barang(){
    	return $this->belongsTo('App\Barang','id_barang');
    }
}
