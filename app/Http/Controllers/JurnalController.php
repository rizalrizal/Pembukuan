<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\JurnalExport;
use Maatwebsite\Excel\Facades\Excel;
use CustomHelp;
class JurnalController extends Controller
{
	 public function index(){
    	return view('jurnal.index');
    }

    public function getJurnal($tgl_awal,$tgl_akhir,$limit){
    	//$tmodify = new DateTime($tgl_akhir);
    	$jurnal = DB::select( DB::raw("SELECT g2.tanggal, COALESCE(g2.nama_penjual,g2.nama_pembeli) AS Nama,CASE WHEN g2.nama_penjual = 0 THEN 'Pembelian' ELSE 'Penjualan' END AS 'TipeTransaksi',g2.total_jual AS Kredit,g2.total_beli AS Debit, SUM(COALESCE(g1.total_jual, 0) - COALESCE(g1.total_beli, 0)) AS Saldo
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
    GROUP BY g2.urutan_tgl,g2.tanggal, g2.total_jual, g2.total_beli, g2.nama_penjual , g2.nama_pembeli limit 100 offset $limit
"), array(
	   'tgl_awal' => $tgl_awal,
	   'tgl_akhir' => $tgl_akhir,
	 ));
			
			$urlExcel = url('/jurnal/export_excel/'.$tgl_awal.'/'.$tgl_akhir);
      if($limit == 0){
          $html = '<a href="'.$urlExcel.'" class="btn btn-success my-3 float-right" target="_blank">Export Excel</a>
        <table class="table table-hover"  id="data_jurnal">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama</th>
                      <th>Tipe Transaksi</th>
                      <th>Kredit</th>
                      <th>Debit</th>
                      <th>Saldo</th>
                    </tr>
                  </thead>
                  <tbody>';
                  $jumlahDt = count($jurnal);
                  if($jumlahDt>0){
                    $no=1;
                    foreach ($jurnal as $j) {
                      $date=date_create($j->tanggal);
                      $html .= "<tr>
                        <td>$no</td>
                        <td>".date_format($date,"d-M-Y")."</td>
                        <td>$j->Nama</td>
                        <td>";
                        if($j->TipeTransaksi=='Penjualan'){
                          $html .= '<span class="badge bg-success">'.$j->TipeTransaksi.'</span>';
                        }else{
                          $html .= '<span class="badge bg-danger">'.$j->TipeTransaksi.'</span>';
                        }
              $html .= "</td>
                        <td>".CustomHelp::rupiah($j->Kredit)."</td>
                        <td>".CustomHelp::rupiah($j->Debit)."</td>
                        <td>".CustomHelp::rupiah($j->Saldo)."</td>
                      </tr>";


                      $no++;
                    }
                  }else{
                    $html .= "<tr><td colspan='7' style='text-align:center;'>Tidak Ada Jurnal</td></tr>";
                  }                  
                 
                  $html .= '</tbody></table>   ';
                  $dateAwal=date_create($tgl_awal);
                  $dateAkhir=date_create($tgl_akhir);
                  $jurnalTitle = "Jurnal ".date_format($dateAwal,"d-M-Y")." s/d ".date_format($dateAkhir,"d-M-Y");

                $data =array("title"=>$jurnalTitle,"dt"=>$html);
      }else{
         $jumlahDt = count($jurnal);
                  if($jumlahDt>0){
            $dt = array();
          $no=$limit+1;
                    foreach ($jurnal as $j) {
                      $date=date_create($j->tanggal);
                      $row = array();
                      $row['no'] = $no;
                      $row['tanggal'] = date_format($date,"d-M-Y");
                      $row['nama'] = $j->Nama;
                      if($j->TipeTransaksi=='Penjualan'){
                          $row['tipe'] = '<span class="badge bg-success">'.$j->TipeTransaksi.'</span>';
                        }else{
                          $row['tipe'] = '<span class="badge bg-danger">'.$j->TipeTransaksi.'</span>';
                        }
                        $row['kredit'] =CustomHelp::rupiah($j->Kredit);
                        $row['debit'] =CustomHelp::rupiah($j->Debit);
                        $row['saldo'] =CustomHelp::rupiah($j->Saldo);                    

                      $dt[] = $row;

                      $no++;
        }

       $data =array("dt"=>$dt,"cek"=>1);
     }else{
        $dt = array();
        $data =array("dt"=>$dt,"cek"=>0);
     }
    }
    	
                
				return json_encode($data);
    }

    public function export_excel($tgl_awal,$tgl_akhir)
  {

  	$dateAwal=date_create($tgl_awal);
	$dateAkhir=date_create($tgl_akhir);
	$jurnalTitle = "Jurnal ".date_format($dateAwal,"d-M-Y")." sd ".date_format($dateAkhir,"d-M-Y");
    return Excel::download(new JurnalExport($tgl_awal,$tgl_akhir), $jurnalTitle.'.xlsx');
  }
    
}
