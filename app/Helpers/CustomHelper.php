<?php
namespace App\Helpers;


class CustomHelper {
    public static function rupiah($angka) {
       $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
	   return $hasil_rupiah;
    }
    public static function numberFormat($angka) {
       return number_format($angka,0,',','.');
    }
}