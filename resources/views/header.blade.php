<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item dropdown user user-menu">
    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
      <img src="{{ asset("template/dist/img/avatar5.png")}}" class="user-image img-circle elevation-2" alt="User Image">
      <span class="hidden-xs"> {{ ucfirst(Auth::user()->name) }} </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
      <!-- User image -->
      <li class="user-header bg-primary">
        <img src="{{ asset("template/dist/img/avatar5.png")}}" class="img-circle elevation-2" alt="User Image">

        <p>
          {{ ucfirst(Auth::user()->name) }}
          <small>Admin</small>
        </p>
      </li>
      <!-- Menu Body -->

      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="float-left">
          <a href="{{ route('profil') }}" class="btn btn-default btn-flat" > Profil</a>
        </div>
        <div class="float-right">
          <a href="{{ route('logout') }}" class="btn btn-default btn-flat"  onclick="event.preventDefault();document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
        </div>
      </li>
    </ul>
  </li>

    </ul>
  </nav>
  <!-- /.navbar -->