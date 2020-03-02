<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;
class JurnalExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct($tgl_awal,$tgl_akhir)
    {
        $this->tgl_awal = $tgl_awal;
        $this->tgl_akhir = $tgl_akhir;
    }

    public function collection()
    {
        $jurnal = DB::select( DB::raw("SELECT DATE_FORMAT(g2.tanggal,'%d/%m/%Y') as tanggal, COALESCE(g2.nama_penjual,g2.nama_pembeli) AS Nama,CASE WHEN g2.nama_penjual = 0 THEN 'Pembelian' ELSE 'Penjualan' END AS 'TipeTransaksi',g2.total_jual AS Kredit,g2.total_beli AS Debit, SUM(COALESCE(g1.total_jual, 0) - COALESCE(g1.total_beli, 0)) AS Saldo
FROM (SELECT 
		urutan_tgl,
        tanggal, 
        nama_pembeli, 
        0 nama_penjual,
        total_jual,
        0 total_beli
    FROM penjualan
    UNION
    SELECT
    	urutan_tgl, 
        tanggal, 
        0 nama_pembeli,
        nama_penjual, 
        0 total_jual,
        total_beli
    FROM pembelian ORDER BY urutan_tgl ASC) AS g1 INNER JOIN 
    (SELECT
    	urutan_tgl,
        tanggal, 
        nama_pembeli, 
        NULL nama_penjual,
        total_jual,
        0 total_beli
    FROM penjualan
    UNION
    SELECT
    	urutan_tgl, 
        tanggal, 
        NULL nama_pembeli,
        nama_penjual, 
        0 total_jual,
        total_beli
    FROM pembelian ORDER BY urutan_tgl ASC) AS g2 ON g1.urutan_tgl <= g2.urutan_tgl 
    WHERE g2.tanggal >= :tgl_awal AND g2.tanggal <= :tgl_akhir 
    GROUP BY g2.urutan_tgl,g2.tanggal, g2.total_jual, g2.total_beli, g2.nama_penjual , g2.nama_pembeli
"), array(
	   'tgl_awal' => $this->tgl_awal,
	   'tgl_akhir' => $this->tgl_akhir,
	 ));

         return collect($jurnal);

    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Nama',
            'Tipe Transaksi',
            'Kredit',
            'Debit',
            'Saldo',
        ];
    }

    
}
