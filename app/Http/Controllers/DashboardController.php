<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
class DashboardController extends Controller
{
   	public function index(){
   		return view('dashboard');
   	}

   	public function dataBarangSisa(Request $request){
    	 $columns = array( 
                            0 =>'id', 
                            1 =>'kode_barang',
                            2=> 'nama_barang',
                            3=> 'stok',
                        );
  
        $totalData = Barang::where('stok','<',10)->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
         
            $barangs = Barang::where('stok','<',10)
            			 ->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();


        $data = array();
        if(!empty($barangs))
        {
        	$no=1;
            foreach ($barangs as $barang)
            {
                
                $nestedData['no'] = $no;
                $nestedData['kode_barang'] = $barang->kode_barang;
                $nestedData['nama_barang'] = $barang->nama_barang;
                $nestedData['stok'] = $barang->stok;
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
