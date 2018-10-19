<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('adminlte')}}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Links</li>
        <li class="treeview @if(!empty($MenuOpen) && $MenuOpen=='customers') active menu-open @endif">
          <a href="#"><i class="fa fa-link"></i> <span>Customers</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li @if(!empty($MenuActive) && $MenuActive == 'customersIndex') class="active" @endif ><a href="{{url('customers')}}"><i class="fa fa-link"></i> <span>List</span></a></li>
          <li @if(!empty($MenuActive) && $MenuActive == 'customersCreate') class="active" @endif ><a href="{{url('customers/create')}}"><i class="fa fa-link"></i> <span>Add Customer</span></a></li>
          </ul>
        </li>

        <li class="treeview @if(!empty($MenuOpen) && $MenuOpen=='products') active menu-open @endif">
          <a href="#"><i class="fa fa-link"></i> <span>Products</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li @if(!empty($MenuActive) && $MenuActive == 'productsIndex') class="active" @endif ><a href="{{url('products')}}"><i class="fa fa-link"></i> <span>List</span></a></li>
          <li @if(!empty($MenuActive) && $MenuActive == 'productsCreate') class="active" @endif ><a href="{{url('products/create')}}"><i class="fa fa-link"></i> <span>Add Product</span></a></li>
          </ul>
        </li>

        
        <li class="treeview @if(!empty($MenuOpen) && $MenuOpen=='invoices') active menu-open @endif">
          <a href="#"><i class="fa fa-link"></i> <span>Invoices</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li @if(!empty($MenuActive) && $MenuActive == 'invoicesIndex') class="active" @endif ><a href="{{url('invoices')}}"><i class="fa fa-link"></i> <span>All Invoices</span></a></li>
          <li @if(!empty($MenuActive) && $MenuActive == 'invoicesCreate') class="active" @endif ><a href="{{url('invoices/create')}}"><i class="fa fa-link"></i> <span>Add New Invoice</span></a></li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
