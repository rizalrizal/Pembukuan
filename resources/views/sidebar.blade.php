<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link">
      <img src="{{asset("template/dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Pembukuan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      

      <!-- Sidebar Menu -->
      <nav class="mt-3">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

           {{-- PENJUALAN --}}
           <li class="nav-item">
            <a href="{{url('/')}}" class="nav-link @if($page=='') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
         <li class="nav-item">
            <a href="{{url('/barang')}}" class="nav-link @if($page=='barang') active @endif">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Barang
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/penjualan')}}" class="nav-link @if($page=='penjualan') active @endif">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Penjualan
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/pembelian')}}" class="nav-link @if($page=='pembelian') active @endif">
              <i class="nav-icon fas fa-cart-plus fa-flip-horizontal"></i>
              <p>
                Pembelian
              </p>
            </a>
          </li>

          <li class="nav-item" style="border-bottom: 1px solid #4b545c;">
            <a href="{{url('/jurnal')}}" class="nav-link @if($page=='jurnal') active @endif">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Jurnal
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url('/profil')}}" class="nav-link @if($page=='profil') active @endif">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Profil
              </p>
            </a>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>