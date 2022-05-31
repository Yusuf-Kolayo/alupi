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
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
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
              <p> Dashboard </p>
            </a> 
          </li> 
  
   
      
          <li class="nav-item">
            <a href="{{ route('vendor.my_priced_products') }}" class="nav-link">
              <i class="nav-icon fa fa-check-circle"></i>
              <p> Priced Products</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('vendor.my_unpriced_products') }}" class="nav-link">
              <i class="nav-icon fa fa-question-circle"></i>
              <p> Unpriced Products</p>
            </a>
          </li>
  
  
          <li class="nav-item">
            <a href="JavaScript:void(0)" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                 Catalog
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> 
        
              <ul class="nav nav-treeview"> 
                @foreach ($main_categories as $main_category)
                <li class="nav-item">
                  <a href="JavaScript:void(0)" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      {{$main_category->cat_name}}
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    @foreach ($main_category->children as $item)
                    <li class="nav-item">
                      <a href="{{route('product.sub',['sub_category_id'=>$item->id])}}" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p> {{$item->cat_name}}</p>
                      </a>
                    </li> 
                    @endforeach 
                  </ul>
                </li> 
                @endforeach 
              </ul> 
          </li> 
  
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  