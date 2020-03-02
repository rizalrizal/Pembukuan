<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public function detail_penjualan(){
    	return $this->belongsTo('App\DetailPenjualan','id');
    }

     public function detail_pembelian(){
    	return $this->belongsTo('App\DetailPembelian','id');
    }
}
