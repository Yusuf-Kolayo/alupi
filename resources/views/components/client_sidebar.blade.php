{{-- ASIDE NAVBAR --}}

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('dashboard') }}" class="brand-link">
    <img src=" {{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"> ALUPI ITN'L</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">


    <!-- SidebarSearch Form -->
    <div class="form-inline mt-2">
      <div class="input-group" data-widget="sidebar-search">
        {{-- <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div> --}}
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
             
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link ">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p> {{__('Dashboard')}} </p>
          </a> 
        </li>    



          
        <li class="nav-item">
          <a href="{{route('shop.shop_default')}}" class="nav-link">
            <i class="nav-icon fas fa-shopping-cart"></i>
            <p> Catalog  </p>
          </a>  
        </li>    

        


      @if (auth()->user()->client->has_agent() == true)
      <li class="nav-item">
        <a href="{{ route('client.my_account_oficer', ['agent'=>auth()->user()->client->agent->agent_id]) }}" class="nav-link ">
          <i class="nav-icon fas fa-user"></i>
          <p> {{__('Account Officer')}} </p>
        </a> 
      </li>    
      @endif
       
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
