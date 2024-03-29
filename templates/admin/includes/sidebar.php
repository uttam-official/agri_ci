

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=base_url('admin')?>" class="brand-link">
        <img src="<?=base_url('templates/admin')?>/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?=base_url('admin')?>" class="nav-link dashboard">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/category')?>" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/subcategory')?>" class="nav-link">
                        <i class="nav-icon fas fa-list-alt"></i>
                        <p>
                            Sub Category
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/product')?>" class="nav-link">
                        <i class="nav-icon fa fa-box-open"></i>
                        <p>
                            Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/order')?>" class="nav-link">
                        <i class="nav-icon fa fa-shopping-cart"></i>
                        <p>
                            Order
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/discount')?>" class="nav-link">
                        <i class="nav-icon fa fa-percent"></i>
                        <p>
                            Discount
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/customer')?>" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?=base_url('admin/settings')?>" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>