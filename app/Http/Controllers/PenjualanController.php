<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Penjualan;
use App\Pembelian;
use App\DetailPenjualan;
use App\Barang;
use Session;
use CustomHelp;
class PenjualanController extends Controller
{
    public function index(){
    	$list_barang = Barang::orderBy('kode_barang', 'asc')->get();
    	return view('penjualan.index',compact('list_barang'));
    }

    public function cekStock($id_barang,$jumlah){
    	$barang = Barang::find($id_barang);
      $status = ($jumlah > $barang->stok) ? 1 : 0;
      $data =array("status"=>$status,"nama_barang"=>$barang->nama_barang,"stok"=>$barang->stok);
      return json_encode($data);
    }

    public function getHargaJual($id_barang){
      $barang = Barang::find($id_barang);
      return $barang->harga_jual;
    }

    public function getDetailJual($id_penjualan){
        $penjualan = Penjualan::where('id','=',"$id_penjualan")->first();
        $detailPenjualan = DetailPenjualan::where('id_penjualan','=',"$id_penjualan")->get();
        $no = 1;
        $html = "<label>Tanggal : ".$penjualan->tanggal->format('d-M-Y')."</label><br>
              <label>Nama Pembeli : $penjualan->nama_pembeli </label>
              <div class='table-responsive p-0' style='height: 300px;'>
                <table class='table table-head-fixed'>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Jumlah</th>
                      <th>Harga</th>
                      <th>Diskon</th>
                    </tr>
                  </thead>
                  <tbody>";
                  $subtotal = 0;
                   foreach ($detailPenjualan as $dp) {            
                       $subtotal = $subtotal + ($dp->harga_jual * $dp->jumlah_barang);
                       $html .= "<tr>
                                <td>$no</td>
                                <td>".$dp->barang->nama_barang."</td>
                                <td>$dp->jumlah_barang</td>
                                <td>".CustomHelp::rupiah($dp->harga_jual)."</td>
                                <td>$dp->diskon %</td>
                              </tr>";
                              $no++;
                  }
                   
                   $diskon = $subtotal - $penjualan->total_jual; 
                  $html .= "</tbody>
                </table>
              </div>
              <div class='row'>
                
                <div class='col-6'>
                  
                </div>
                <div class='col-6'>
                <br>

                  <div class='table-responsive'>
                    <table class='table'>
                      <tbody>
                      <tr>
                        <th>Sub Total:</th>
                        <td>".CustomHelp::rupiah($subtotal)."</td>
                      </tr>
                      <tr>
                        <th>Diskon:</th>
                        <td>".CustomHelp::rupiah($diskon)."</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>".CustomHelp::rupiah($penjualan->total_jual)."</td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                
              </div>";

              return $html;
    }

    public function store(Request $request){
      $jualCount = Penjualan::where('tanggal','=',"$request->tanggal")->count();
      $beliCount = Pembelian::where('tanggal','=',"$request->tanggal")->count();
      
      $dateModify=date_create($request->tanggal);
      $dateModify = date_format($dateModify,"Ymd");
   
      $NoUrut = $jualCount + $beliCount + 1;
      //setelah ketemu id terakhir lanjut membuat id baru dengan format sbb:
      $urutan_tgl = $dateModify .sprintf('%05s', $NoUrut);


    	$total = 0;    	
    	$jmlArray = count($request->barang);
    	for ($i=0; $i < $jmlArray; $i++) { 
    		$diskon = 0;
    		$subTotal = $request->jumlah[$i] * $request->harga_jual[$i];
    		if(isset($request->diskon[$i])){ 
    			$diskon = $request->diskon[$i] ;
    			$cariDiskon = $subTotal - (($subTotal * $diskon)/100);
    			$total = $total + $cariDiskon;
    		}else{
    			$total = $total + $subTotal;
    		}
    	}
    	  $penjualan = new Penjualan;
        $penjualan->tanggal = $request->tanggal;
        $penjualan->nama_pembeli = $request->nama_pembeli;
        $penjualan->total_jual = $total;
        $penjualan->urutan_tgl = $urutan_tgl;
        $penjualan->save();	
        for ($i=0; $i < $jmlArray; $i++) { 
    		$diskon = 0;
    		if(isset($request->diskon[$i])){ $diskon = $request->diskon[$i]; };
    		$detailpenjualan = new DetailPenjualan;
	        $detailpenjualan->id_barang = $request->barang[$i];
	        $detailpenjualan->id_penjualan = $penjualan->id;
	        $detailpenjualan->jumlah_barang = $request->jumlah[$i];
	        $detailpenjualan->harga_jual = $request->harga_jual[$i];
	        $detailpenjualan->diskon = $diskon;
	        $detailpenjualan->save();	

	        $barang = Barang::find($request->barang[$i]);
	        $sisaStok = $barang->stok - $request->jumlah[$i];
	        $updateStok=Barang::where('id',$request->barang[$i])->update([
	            'stok' =>$sisaStok
	        ]);
    	}
        Session::flash('flash_message','Data Penjualan Berhasil Disimpan');
        return redirect('/penjualan');

    }


  

    public function dataPenjualan(Request $request){
         $columns = array( 
                            0 =>'id', 
                            1 =>'tanggal',
                            2=> 'nama_pembeli',
                            3=> 'total_jual',
                            4=> 'id',
                        );
  
        $totalData = Penjualan::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $penjualans = Penjualan::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $penjualans =  Penjualan::where('tanggal','LIKE',"%{$search}%")
                            ->orWhere('nama_pembeli', 'LIKE',"%{$search}%")
                            ->orWhere('total_jual', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Penjualan::where('tanggal','LIKE',"%{$search}%")
                             ->orWhere('nama_pembeli', 'LIKE',"%{$search}%")
                             ->orWhere('total_jual', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($penjualans))
        {
            $no=1;
            foreach ($penjualans as $penjualan)
            {
                               
                $nestedData['no'] = $no;
                $nestedData['tanggal'] = $penjualan->tanggal->format('d-M-Y');
                $nestedData['nama_pembeli'] = $penjualan->nama_pembeli;
                $nestedData['total_jual'] = CustomHelp::rupiah($penjualan->total_jual);
                $nestedData['aksi'] = "<a href='javascript:void(0);' onclick='show_modal($penjualan->id)' class='btn btn-success btn-sm'>Detail</a>";
                $data[] = $nestedData;
                $no++;
            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }
}
