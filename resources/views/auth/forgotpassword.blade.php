
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pembukuan</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset("template/plugins/fontawesome-free/css/all.min.css")}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset("template/dist/css/adminlte.min.css")}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">

<!-- Automatic element centering -->

<div class="lockscreen-wrapper">

  <div class="lockscreen-logo">

    <a href="{{url('/')}}">Pembukuan</a>

  </div>

  @if (session('message'))

    <div class="alert alert-success">

       <button type="button" class="close" data-dismiss="alert" aria-label="close">&times;</button>

        {{ session('message') }}

    </div>

@endif

  <!-- User name -->

  <div class="lockscreen-name">Forgot Password</div>



  <!-- START LOCK SCREEN ITEM -->

  <div class="lockscreen-item">

    <!-- lockscreen image -->

    <div class="lockscreen-image">

      <img src="{{url('template/dist/img/email.png')}}" alt="User Image">

    </div>

    <!-- /.lockscreen-image -->



    <!-- lockscreen credentials (contains the form) -->

    <form class="lockscreen-credentials" action="/postforgot" method="post">

      @csrf

       <div class="input-group">

        <input type="email" class="form-control" placeholder="Email" name="email" id="email">

        <div class="input-group-btn">

          <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>

        </div>

      </div>

    </form>

    <!-- /.lockscreen credentials -->



  </div>

  <!-- /.lockscreen-item -->

  @if($errors->has('email'))

  <div class="text-center">

          <span class="help-block text-red">{{$errors->first('email')}}</span>

        @endif

        </div>

  <div class="help-block text-left" style="width: 300px;margin: 0 auto;">

    Please enter your email address. You will receive a link to create new password via email. Check your inbox or spam.

  </div>

  {{-- <div class="text-center">

    <a href="login.html">Or sign in as a different user</a>

  </div> --}}





  <div class="lockscreen-footer text-center">

   Copyright &copy; 2019  <b><a href="https://durioindigo.co.id/">Durio Indigo</a></b><br>

    All rights reserved

  </div>

</div>

<!-- /.center -->
<!-- jQuery -->
<script src="{{asset("template/plugins/jquery/jquery.min.js")}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset("template/plugins/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
</body>
</html>
