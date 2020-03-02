@extends('layouts.admin_template')

@section('content-header')
<div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Profil</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Profil</li>
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
                <h3 class="card-title">Profil</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" action="{{route('profil.update',Auth::user()->id)}}">
                 {{csrf_field()}}
                <div class="card-body">
                <div class="row">
                <div class="col-md-12">
                   
                    <div class="form-group">
                    <label for="name">Nama</label>

                    <input type="text" class="form-control @if($errors->any()) {{$errors->has('name')?'is-invalid':'is-valid'}} @endif" id="name" name="name" value="{{ Auth::user()->name }}">
                    @if($errors->has('name'))
                    <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('name')}}</label>
                    @endif
                  </div>
                    <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @if($errors->any()) {{$errors->has('email')?'is-invalid':'is-valid'}} @endif" id="email" name="email" value="{{ Auth::user()->email }}">
                     @if($errors->has('email'))
                      <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('email')}}</label>
                    @endif
                  </div>
                  
                      <div class="form-group">
                    <label for="password">Password</label>

                    <input type="password" class="form-control @if($errors->any()) {{$errors->has('password')?'is-invalid':'is-valid'}} @endif" id="password" name="password" value="" placeholder="Kosongkan jika tidak mengubah password">
                    @if($errors->has('password'))
                    <label class="control-label" for="inputError"><i class="far fa-times-circle"></i> {{$errors->first('password')}}</label>
                    @endif
                  </div>
              
            
                  
                </div>
              

                </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary float-right">Ubah</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          
        </div>
        <!-- /.row -->

       

      </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
@endsection

@section('addscript')
<script type="text/javascript">
$( document ).ready(function() {
    
   
 });
</script>
@endsection