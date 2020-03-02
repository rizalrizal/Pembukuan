@extends('layouts.admin_template')

@section('content-header')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Penjualan</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Penjualan</li>
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
                <h3 class="card-title">Penjualan</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('penjualan.add')}}">
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
                    <label for="nama_pembeli">Nama Pembeli</label>
                    <input type="text" class="form-control" id="nama_pembeli" name="nama_pembeli" required>
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
                        <input type="number" class="form-control" name="jumlah[]" id="jumlah" required min="1">
                      </div>
                  </div>
                  <div class="col-2">
                      <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="text" class="form-control" name="harga_jual[]" id="harga_jual" onkeydown="return false">
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
                    <div id="alert" class="alert alert-warning" style="margin-left: 6px;">
                        <span id="messagestok"></span>
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
                <h3 class="card-title">Data Penjualan</h3>
              </div>
              <!-- /.card-header -->

                <div class="card-body">
                  <table class="table table-hover"  id="data_penjualan">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Nama Pembeli</th>
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
              <h4 class="modal-title">Detail Penjualan</h4>
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
     $( "#alert" ).hide();
     $( "#jumlah" ).keyup(function() {
      var id_jumlah = $(this).attr("id");
      var replaceId = id_jumlah.replace('jumlah', 'barang');//remove string barang
      cekStock( $( this ).val(),id_jumlah,replaceId);
    }).change(function() {
      var id_jumlah = $(this).attr("id");
      var replaceId = id_jumlah.replace('jumlah', 'barang');//remove string barang
      cekStock( $( this ).val(),id_jumlah,replaceId);
    });
    $('#data_penjualan').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "{{ url('datapenjualan') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "no" },
                { "data": "tanggal" },
                { "data": "nama_pembeli" },
                { "data": "total_jual" },
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
      getHargaJual($(this).val());
    });

    var x = 1; //Initial field counter is 1
    var add_more_button = $('.add_button'); //Add button selector
    var Fieldwrapper = $('.input_field_wrapper'); //Input field wrapper
    var fieldHTML = ''; //Initiate
    
    $(add_more_button).click(function(){ //Once add button is clicked
      fieldHTML = '<div class="row r'+x+'"><div class="col-4"><div class="form-group"><label for="barang">Barang</label><select class="form-control select2" name="barang[]"  id="barang'+x+'" style="width: 100%;" required><option value="">Pilih Barang</option>@foreach($list_barang as $lb)<option value="{{$lb->id}}">{{$lb->kode_barang}} - {{$lb->nama_barang}}</option>@endforeach</select></div></div><div class="col-2"><div class="form-group"><label for="jumlah">Jumlah</label><input type="number" class="form-control" id="jumlah'+x+'" name="jumlah[]" required min="1"></div></div> <div class="col-2"><div class="form-group"><label for="harga_jual">Harga Jual</label><input type="text" class="form-control" name="harga_jual[]" id="harga_jual'+x+'"  onkeydown="return false"></div></div> <div class="col-2"><div class="form-group"><label for="diskon">Diskon (%)</label><input type="number" class="form-control" name="diskon[]" min="1" max="100"></div></div><div class="col-2"><div class="form-group"><label for="&nbsp">&nbsp</label><a href="javascript:void(0);" class="remove_button form-control btn btn-danger" title="Hapus Barang">Hapus</a></div></div><div id="alert'+x+'" class="alert alert-warning" style="margin-left: 6px;"><span id="messagestok'+x+'"></span></div></div></div>'; //New input field html 
        $(Fieldwrapper).append(fieldHTML); // Tambah Barang html
        $( "#alert"+x).hide();
           $('#barang'+x).select2({
            theme: 'bootstrap4'
          })
            
            $(Fieldwrapper).on('keyup change', '#jumlah'+x, function(){
               var id_jumlah = $(this).attr("id");
               var replaceId = id_jumlah.replace('jumlah', 'barang');//remove string barang
               cekStock( $( this ).val(),id_jumlah,replaceId);
          });
           $(Fieldwrapper).on('change', '#barang'+x, function(){
              getHargaJual($(this).val(),$(this).attr("id"));
          });
        x++;
    });
    
    $(Fieldwrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
        e.preventDefault();
        $(this).parent("div").parent("div").parent("div").remove(); //Remove field html
    });
    function getHargaJual(id_barang,id_harga_jual = ''){
      if(id_barang == ""){

          if(id_harga_jual==''){
                $( "#harga_jual" ).val("");
              }else{
                var replaceId = id_harga_jual.replace('barang', '');//remove string barang
                $( "#harga_jual"+replaceId ).val("");
              }
      }else{
        $.ajax({
            url: "{{ url('/getHargaJual') }}"+"/"+id_barang,
            success: function(data){
              if(id_harga_jual==''){
                $( "#harga_jual" ).val(data);
              }else{
                var replaceId = id_harga_jual.replace('barang', '');//remove string barang
                $( "#harga_jual"+replaceId ).val(data);
              }
            },
            error : function(){
                alert('Something Error !');
            }  
        }); 
      }
       
      }

      function cekStock(jumlah,id_jumlah,id_barang){
          var replaceId = id_jumlah.replace('jumlah', '');//remove string 
          var jum = 0;
          if(jumlah != ''){
            jum = jumlah;
          }
          if($( "#"+id_barang ).val() == ""){
            alert("pilih dulu barang");
            $( "#"+id_jumlah ).val('');
          }else{
            var id_br = $( "#"+id_barang ).val();
            $.ajax({
                url: "{{ url('/cekStock') }}"+"/"+id_br+"/"+jum,
                dataType : "json",
                success: function(data){
                  if(data.status == 1){
                    $( "#messagestok"+replaceId ).html('Stok '+ data.nama_barang + ' tersisa '+ data.stok);
                    $( "#alert"+replaceId ).show();
                    $('#alert'+replaceId ).delay(3000).slideUp(300);
                    $( "#"+id_jumlah ).val('');
                  }
                },
                error : function(err){
                     alert('Something Error !');
                }  
            }); 
          }
       
      }

     
 });
 function show_modal(id_penjualan){
   $(".modal-body").text("");
    $.ajax({
        url: "{{ url('/getDetailJual') }}"+"/"+id_penjualan,
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