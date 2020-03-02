<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $dates = ['tanggal'];
    public function detail_penjualan(){
    	return $this->belongsTo('App\DetailPenjualan','id');
    }
}
