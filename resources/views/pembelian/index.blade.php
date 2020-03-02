@extends('layouts.admin_template')

@section('content-header')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Pembelian</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Pembelian</li>
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
                <h3 class="card-title">Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('pembelian.add')}}">
                 {{csrf_field()}}
                <div class="card-body">
                <div class="row">
                <div class="col-md-6">
                   
                    <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tanggal" id="tanggal" onkeydown="return false" required>
                  </div>

                  
                  </div>
                </div>
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="nama_penjual">Nama Penjual</label>
                    <input type="text" class="form-control" id="nama_penjual" name="nama_penjual" required>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                  <div class="col-4">
                    <div class="form-group">
                      <label for="barang">Barang</label>
                      <select class="form-control select2" id="barang" name="barang[]" style="width: 100%;" required>
                           <option value="">Pilih Barang</option>
                            @foreach($list_barang as $lb)
                              <option value="{{$lb->id}}">{{$lb->kode_barang}} - {{$lb->nama_barang}}</option>
                            @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-2">
                       <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" name="jumlah[]" required min="1">
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label for="harga_beli">Harga Beli</label>
                        <input type="text" class="form-control" name="harga_beli[]" id="harga_beli" onkeydown="return false">
                      </div>
                  </div>
                  <div class="col-2">
                       <div class="form-group">
                        <label for="diskon">Diskon (%)</label>
                        <input type="number" class="form-control" name="diskon[]" min="1" max="100">
                      </div>
                  </div>
                  <div class="col-2">
                          <div class="form-group">
                            <label for="&nbsp">&nbsp</label>
                            <a href="javascript:void(0);" class="add_button form-control btn btn-success" title="Tambah Barang">Tambah</a>
                          </div>
                  </div>
                   
                  </div>
                  <div class="input_field_wrapper">
                     
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

         <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Data Pembelian</h3>
              </div>
              <!-- /.card-header -->
    
                <div class="card-body">
                  <table class="table table-hover"  id="data_pembelian">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Penjual</th>
                      <th>Total</th>
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

        <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail Pembelian</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default float-right" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
@endsection

@section('addscript')
<script type="text/javascript">
$( document ).ready(function() {

  $('#data_pembelian').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('datapembelian') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "no" },
                { "data": "tanggal" },
                { "data": "nama_penjual" },
                { "data": "total_beli" },
                { "data": "aksi" }
            ],
            "columnDefs": [ {
                "targets": [0,4],
                "orderable": false
            } ]  

        });
    //Initialize Select2 Elements
    $('#barang').select2({
      theme: 'bootstrap4'
    });

    $( "#tanggal" ).datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true
    });
    $( "#barang" ).change(function() {
      getHargabeli($(this).val());
    });

    var x = 1; //Initial field counter is 1
    var add_more_button = $('.add_button'); //Add button selector
    var Fieldwrapper = $('.input_field_wrapper'); //Input field wrapper
    var fieldHTML = ''; //Initiate
    
    $(add_more_button).click(function(){ //Once add button is clicked
      fieldHTML = '<div class="row r'+x+'"><div class="col-4"><div class="form-group"><label for="barang">Barang</label><select class="form-control select2" name="barang[]"  id="barang'+x+'" style="width: 100%;" required><option value="">Pilih Barang</option>@foreach($list_barang as $lb)<option value="{{$lb->id}}">{{$lb->kode_barang}} - {{$lb->nama_barang}}</option>@endforeach</select></div></div><div class="col-2"><div class="form-group"><label for="jumlah">Jumlah</label><input type="number" class="form-control" name="jumlah[]" required min="1"></div></div> <div class="col-2"><div class="form-group"><label for="harga_beli">Harga beli</label><input type="text" class="form-control" name="harga_beli[]" id="harga_beli'+x+'"  onkeydown="return false"></div></div> <div class="col-2"><div class="form-group"><label for="diskon">Diskon (%)</label><input type="number" class="form-control" name="diskon[]" min="1" max="100"></div></div><div class="col-2"><div class="form-group"><label for="&nbsp">&nbsp</label><a href="javascript:void(0);" class="remove_button form-control btn btn-danger" title="Hapus Barang">Hapus</a></div></div></div>'; //New input field html 
        $(Fieldwrapper).append(fieldHTML); // Add field html
           $('#barang'+x).select2({
            theme: 'bootstrap4'
          })
           $(Fieldwrapper).on('change', '#barang'+x, function(){
              getHargabeli($(this).val(),$(this).attr("id"));
          });
        x++;
    });
    
    $(Fieldwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent("div").parent("div").parent("div").remove(); //Remove field html
    });
    function getHargabeli(id_barang,id_harga_beli = ''){
      if(id_barang == ""){
         if(id_harga_beli==''){
                $( "#harga_beli" ).val("");
              }else{
                var replaceId = id_harga_beli.replace('barang', '');//remove string barang
                $( "#harga_beli"+replaceId ).val("");
              }
      }else{
        $.ajax({
            url: "{{ url('/getHargaBeli') }}"+"/"+id_barang,
            success: function(data){
              if(id_harga_beli==''){
                $( "#harga_beli" ).val(data);
              }else{
                var replaceId = id_harga_beli.replace('barang', '');//remove string barang
                $( "#harga_beli"+replaceId ).val(data);
              }
            },
            error : function(){
                alert('Something Error !');
            }  
        }); 
      }
       
      }
 });

 function show_modal(id_pembelian){
   $(".modal-body").text("");
    $.ajax({
        url: "{{ url('/getDetailBeli') }}"+"/"+id_pembelian,
        success: function(data){
             $(".modal-body").html(data);
        },
        error : function(){
            $(".modal-body").html('Something Error !');
        }  
    });
  $('#modal-lg').modal('show');
}
</script>
@endsection