@extends('layouts.admin_template')

@section('content-header')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"><a href="{{url('/')}}">Dashboard</a></li>
              </ol>
            </div><!-- /.col -->
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
                <h3 class="card-title">Data Stok Barang Dibawah 10</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form">
                <div class="card-body">
                  <table class="table table-hover"  id="data_sisa">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Barang</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                    </tr>
                  </thead>
                 
                </table>
                </div>
                <!-- /.card-body -->

              
              </form>
            </div>
            <!-- /.card -->

          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('addscript')
<script type="text/javascript">
$( document ).ready(function() {


      $('#data_sisa').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": false,
            "ajax":{
                     "url": "{{ url('databarangsisa') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "no" },
                { "data": "kode_barang" },
                { "data": "nama_barang" },
                { "data": "stok" },
            ],
            "columnDefs": [ {
                "targets": 0,
                "orderable": false
            } ]  

        });
 });
</script>
@endsection