<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pembelian;
use App\Penjualan;
use App\DetailPembelian;
use App\Barang;
use Session;
use CustomHelp;
class PembelianController extends Controller
{
    public function index(){
    	$list_barang = Barang::orderBy('kode_barang', 'asc')->get();
    	return view('pembelian.index',compact('list_barang'));
    }

    public function getHargaBeli($id_barang){
    	$barang = Barang::find($id_barang);
    	return $barang->harga_beli;
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
    		$subTotal = $request->jumlah[$i] * $request->harga_beli[$i];
    		if(isset($request->diskon[$i])){ 
    			$diskon = $request->diskon[$i] ;
    			$cariDiskon = $subTotal - (($subTotal * $diskon)/100);
    			$total = $total + $cariDiskon;
    		}else{
    			$total = $total + $subTotal;
    		}
    	}
    	$pembelian = new Pembelian;
        $pembelian->tanggal = $request->tanggal;
        $pembelian->nama_penjual = $request->nama_penjual;
        $pembelian->total_beli = $total;
        $pembelian->urutan_tgl = $urutan_tgl;
        $pembelian->save();	
        for ($i=0; $i < $jmlArray; $i++) { 
    		$diskon = 0;
    		if(isset($request->diskon[$i])){ $diskon = $request->diskon[$i]; };
    		$detailpembelian = new Detailpembelian;
	        $detailpembelian->id_barang = $request->barang[$i];
	        $detailpembelian->id_pembelian = $pembelian->id;
	        $detailpembelian->jumlah_barang = $request->jumlah[$i];
	        $detailpembelian->harga_beli = $request->harga_beli[$i];
	        $detailpembelian->diskon = $diskon;
	        $detailpembelian->save();	

	        $barang = Barang::find($request->barang[$i]);
	        $sisaStok = $barang->stok + $request->jumlah[$i];
	        $updateStok=Barang::where('id',$request->barang[$i])->update([
	            'stok' =>$sisaStok
	        ]);
    	}
        Session::flash('flash_message','Data Pembelian Berhasil Disimpan');
        return redirect('/pembelian');

    }

    public function getDetailBeli($id_pembelian){
        $pembelian = Pembelian::where('id','=',"$id_pembelian")->first();
        $detailPembelian = DetailPembelian::where('id_pembelian','=',"$id_pembelian")->get();
        $no = 1;
        $html = "<label>Tanggal : ".$pembelian->tanggal->format('d-M-Y')."</label><br>
              <label>Nama Penjual : $pembelian->nama_penjual </label>
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
                   foreach ($detailPembelian as $dp) {            
                        $subtotal = $subtotal + ($dp->harga_beli * $dp->jumlah_barang);
                         $html .= "<tr>
                                  <td>$no</td>
                                  <td>".$dp->barang->nama_barang."</td>
                                  <td>$dp->jumlah_barang</td>
                                  <td>".CustomHelp::rupiah($dp->harga_beli)."</td>
                                  <td>".$dp->diskon." %</td>
                                </tr>";
                                $no++;
                    }

                    $diskon = $subtotal - $pembelian->total_beli;
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
                        <td>".CustomHelp::rupiah($pembelian->total_beli)."</td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                
              </div>";

              return $html;
    }

    public function dataPembelian(Request $request){
         $columns = array( 
                            0 =>'id', 
                            1 =>'tanggal',
                            2=> 'nama_penjual',
                            3=> 'total_beli',
                            4=> 'id',
                        );
  
        $totalData = Pembelian::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $pembelians = pembelian::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $pembelians =  Pembelian::where('tanggal','LIKE',"%{$search}%")
                            ->orWhere('nama_penjual', 'LIKE',"%{$search}%")
                            ->orWhere('total_beli', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = pembelian::where('tanggal','LIKE',"%{$search}%")
                             ->orWhere('nama_penjual', 'LIKE',"%{$search}%")
                             ->orWhere('total_beli', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($pembelians))
        {
            $no=1;
            foreach ($pembelians as $pembelian)
            {
                               
                $nestedData['no'] = $no;
                $nestedData['tanggal'] = $pembelian->tanggal->format('d-M-Y');
                $nestedData['nama_penjual'] = $pembelian->nama_penjual;
                $nestedData['total_beli'] = CustomHelp::rupiah($pembelian->total_beli);
                $nestedData['aksi'] = "<a href='javascript:void(0);' onclick='show_modal($pembelian->id)' class='btn btn-success btn-sm'>Detail</a>";
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
