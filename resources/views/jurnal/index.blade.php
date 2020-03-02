@extends('layouts.admin_template')

@section('content-header')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Jurnal</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Jurnal</li>
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


          <div class="col-md-6 offset-md-3">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Filter Jurnal</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form onsubmit="getDataJurnal(0); return false;">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-5">
                           
                    <div class="form-group">
                    <label for="tanggal_awal">Tanggal Awal</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tanggal_awal" id="tanggal_awal" onkeydown="return false" required>
                  </div>

                  
                  </div>
                        
                
                      
                    </div>
                    <div class="col-md-2 text-center">
                           <div class="form-group">
                    
                        <label>&nbsp;</label><br>
                        <span>s/d</span>
                  
                  </div>
                    </div>
                    <div class="col-md-5">
                       <div class="form-group">
                    <label for="tanggal_akhir">Tanggal Akhir</label>
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="far fa-calendar-alt"></i>
                      </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tanggal_akhir" id="tanggal_akhir" onkeydown="return false" required>
                  </div>

                  
                  </div>
                      
                    </div>

                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary btn-block">FILTER</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          
        </div>
        <!-- /.row -->
          

          <div class="col-md-12" id="dtj">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title" id="titlejurnal">Jurnal</h3>
              </div>
              <!-- /.card-header -->
              
                <div class="card-body" id="dtjurnal">
               
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
var limit = 0;

$( document ).ready(function() {
    $(window).scroll(function() {
    if($(window).scrollTop() == $(document).height() - $(window).height()) {
            limit = limit + 100;
           // ajax call get data from server and append to the div
           getDataJurnal2();
    }
});  

      $( "#tanggal_awal" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
      });
      $( "#tanggal_akhir" ).datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        beforeShow: function() {
            setTimeout(function(){
                $('.ui-datepicker').css('z-index', 99999999999999);
            }, 0);
        }
      });
  $("#dtj").hide();
      
 });
function getDataJurnal(){
    limit = 0;
  var tanggal_awal = $( "#tanggal_awal" ).val();
  var tanggal_akhir = $( "#tanggal_akhir" ).val();
    $.ajax({
        url: "{{ url('/getJurnal') }}"+"/"+tanggal_awal+"/"+tanggal_akhir+"/"+limit,
        dataType : "json",
        success: function(data){
             $("#titlejurnal").html(data.title);
             $("#dtjurnal").html(data.dt);
             $("#dtj").show();
        },
        error : function(){
            $("#dtjurnal").html('Something Error !');
        }  
    });
}
function getDataJurnal2(){
  var tanggal_awal = $( "#tanggal_awal" ).val();
  var tanggal_akhir = $( "#tanggal_akhir" ).val();
    $.ajax({
        url: "{{ url('/getJurnal') }}"+"/"+tanggal_awal+"/"+tanggal_akhir+"/"+limit,
        dataType : "json",
        success: function(data){
          if(data.cek == 1){
                $.each(data.dt, function(key, value) {
                   table = document.getElementById("data_jurnal");

                  var rowCount = table.rows.length;
                  var row = table.insertRow(rowCount);

                  var cell1 = row.insertCell(0);
                  cell1.innerHTML = value.no;

                  var cell2 = row.insertCell(1);
                  cell2.innerHTML = value.tanggal;

                  var cell3 = row.insertCell(2);
                  cell3.innerHTML = value.nama;

                  var cell4 = row.insertCell(3);
                  cell4.innerHTML = value.tipe;

                  var cell5 = row.insertCell(4);
                  cell5.innerHTML = value.kredit;

                  var cell6 = row.insertCell(5);
                  cell6.innerHTML = value.debit;

                  var cell7 = row.insertCell(6);
                  cell7.innerHTML = value.saldo;
                });
          }
        },
        error : function(){
            $("#dtjurnal").html('Something Error !');
        }  
    });
}
</script>
@endsection