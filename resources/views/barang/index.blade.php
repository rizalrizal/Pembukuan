@extends('layouts.admin_template')

@section('content-header')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Barang</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Barang</li>
              </ol>
            </div><!-- /.col -->
            <div class="col-sm-12">
              @include('flash_message')
            </div>
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
@endsection

@section('content')
<div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Tambah Barang</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('barang.store')}}">
                 {{csrf_field()}}
                <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                   
                    <div class="form-group">
                    <label for="kode_barang">Kode Barang</label>

                    <input type="text" class="form-control @if($errors->any()) {{$errors->has('kode_barang')?'is-invalid':'is-valid'}} @endif" id="kode_barang" name="kode_barang" value="{{ old('kode_barang') }}">
                    @if($errors->has('kode_barang'))
                    <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('kode_barang')}}</label>
                    @endif
                  </div>
                    <div class="form-group">
                    <label for="nama_barang">Nama Barang</label>
                    <input type="text" class="form-control @if($errors->any()) {{$errors->has('nama_barang')?'is-invalid':'is-valid'}} @endif" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}">
                     @if($errors->has('nama_barang'))
                      <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('nama_barang')}}</label>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="stok">Stok</label>
                    <input type="number" class="form-control @if($errors->any()) {{$errors->has('stok')?'is-invalid':'is-valid'}} @endif" id="stok" name="stok" value="{{ old('stok') }}">
                       @if($errors->has('stok'))
                      <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('stok')}}</label>
                    @endif
                  </div>
            
                  
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="harga_jual">Harga Jual</label>
                    <input type="text" class="form-control @if($errors->any()) {{$errors->has('harga_jual')?'is-invalid':'is-valid'}} @endif" id="harga_jual" name="harga_jual" value="{{ old('harga_jual') }}">
                       @if($errors->has('harga_jual'))
                      <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('harga_jual')}}</label>
                    @endif
                  </div>
                  <div class="form-group">
                    <label for="harga_beli">Harga Beli</label>
                    <input type="text" class="form-control @if($errors->any()) {{$errors->has('harga_beli')?'is-invalid':'is-valid'}} @endif" id="harga_beli" name="harga_beli" value="{{ old('harga_beli') }}">
                       @if($errors->has('harga_beli'))
                      <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('harga_beli')}}</label>
                    @endif
                  </div>
                </div>

                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Simpan</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          
        </div>
        <!-- /.row -->

          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data barang</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                	<table class="table table-hover"  id="data_barang">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                      <th>Harga Jual</th>
                      <th>Harga Beli</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                 
                </table>
                </div>
                <!-- /.card-body -->

              
            </div>
            <!-- /.card -->

          
        </div>

      </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('addscript')
<script type="text/javascript">
$( document ).ready(function() {
    
    $( "#harga_beli" ).keyup(function() {
    	$( "#harga_beli" ).val( formatRupiah(this.value) );
    });

	$( "#harga_jual" ).keyup(function() {
    	$( "#harga_jual" ).val( formatRupiah(this.value) );
    });

      $('#data_barang').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('databarang') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "no" },
                { "data": "kode_barang" },
                { "data": "nama_barang" },
                { "data": "stok" },
                { "data": "harga_jual" },
                { "data": "harga_beli" },
                { "data": "aksi" }
            ],
            "columnDefs": [ {
        				"targets": [0,6],
        				"orderable": false
    				} ]	 

        });
 });
</script>
@endsection