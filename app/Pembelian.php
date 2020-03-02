<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
     protected $table = 'pembelian';
    protected $dates = ['tanggal'];
    public function detail_pembelian(){
    	return $this->belongsTo('App\DetailPembelian','id');
    }
}
