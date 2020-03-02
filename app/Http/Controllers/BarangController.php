<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Session;
use CustomHelp;

class BarangController extends Controller
{
    
    public function index(){
	    return view('barang.index');
    }

    public function store(Request $request){
         $this->validate($request,[
            'kode_barang' => 'required|string|unique:barang,kode_barang',
            'nama_barang' => 'required|string',
            'stok' => 'required|numeric',            
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ]);
        $harga_jual = str_replace('.', '', $request->harga_jual);
        $harga_beli = str_replace('.', '', $request->harga_beli);
        $barang = new Barang;
        $barang->kode_barang = $request->kode_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->stok = $request->stok;
        $barang->harga_jual = $harga_jual;
        $barang->harga_beli = $harga_beli;
        $barang->save();
        Session::flash('flash_message','Data Barang Berhasil Disimpan');
        return redirect('/barang');
    }

    public function edit($id){
        $barang=Barang::where('id',$id)->first();
        return view('/barang/edit',['barang' => $barang]);
    }

    public function update(Request $request,$id){
           $this->validate($request,[
            'kode_barang' => 'required|string|unique:barang,kode_barang,'.$id,
            'nama_barang' => 'required|string',
            'stok' => 'required|numeric',            
            'harga_jual' => 'required',
            'harga_beli' => 'required',
        ]);
        $harga_jual = str_replace('.', '', $request->harga_jual);
        $harga_beli = str_replace('.', '', $request->harga_beli);

        $barang=Barang::where('id',$id)->update([
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'stok' => $request->stok,
            'harga_jual' => $harga_jual,
            'harga_beli'=> $harga_beli
        ]);
        Session::flash('flash_message','Data Barang Berhasil Diubah');
        return redirect('/barang');
    }

    public function delete($id){
        Barang::where('id',$id)->delete();
        Session::flash('flash_message','Data Barang Berhasil Dihapus');
        return redirect('/barang');

    }

    public function dataBarang(Request $request){
    	 $columns = array( 
                            0 =>'id', 
                            1 =>'kode_barang',
                            2=> 'nama_barang',
                            3=> 'stok',
                            4=> 'harga_jual',
                            5=> 'harga_beli',
                            6=> 'id',
                        );
  
        $totalData = Barang::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $barangs = Barang::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        }
        else {
            $search = $request->input('search.value'); 

            $barangs =  Barang::where('kode_barang','LIKE',"%{$search}%")
                            ->orWhere('nama_barang', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Barang::where('kode_barang','LIKE',"%{$search}%")
                             ->orWhere('nama_barang', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($barangs))
        {
        	$no=1;
            foreach ($barangs as $barang)
            {
                
                $edit =  route('barang.edit',$barang->id);
                $delete =  route('barang.delete',$barang->id);
                $nestedData['no'] = $no;
                $nestedData['kode_barang'] = $barang->kode_barang;
                $nestedData['nama_barang'] = $barang->nama_barang;
                $nestedData['stok'] = $barang->stok;
                $nestedData['harga_jual'] = CustomHelp::rupiah($barang->harga_jual);
                $nestedData['harga_beli'] = CustomHelp::rupiah($barang->harga_beli);
                $nestedData['aksi'] = "<a href='$edit' class='btn-warning btn-sm'>Ubah</a>&nbsp; <a href='$delete' class='btn-danger btn-sm' onclick='return confirm(\"Yakin Data Dihapus\")'>Hapus</a>";
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
