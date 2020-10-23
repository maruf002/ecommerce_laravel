 <!-- Left side column. contains the sidebar -->
 <aside class="main-sidebar">
   <!-- sidebar -->
   <div class="sidebar">
      <!-- sidebar menu -->
      <ul class="sidebar-menu">
         <li class="active">
            <a href="index.html"><i class="fa fa-tachometer"></i><span>Dashboard</span>
            <span class="pull-right-container">
            </span>
            </a>
         </li>
         <li class="treeview">
            <a href="#">
            <i class="fa fa-product-hunt"></i><span>Products</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{ route('admin.product.create') }}">Add Product</a></li>
               <li><a href="{{ route('admin.product.index') }}">View Products</a></li>
              
            </ul>
         </li>
         <li class="treeview">
            <a href="#">
            <i class="fa fa-list"></i><span>Category</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{ route('admin.category.create') }}">Add Category</a></li>
               <li><a href="{{ route('admin.category.index') }}">View Category</a></li>
              
            </ul>
         </li>

         <li class="treeview">
            <a href="#">
            <i class="fa fa-gift"></i><span>Coupons</span>
            <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
               <li><a href="{{ route('admin.Coupon') }}">Add Coupon</a></li>
               <li><a href="{{ route('admin.viewCoupon') }}">View Coupons</a></li>
              
            </ul>
         </li>
      
      </ul>
   </div>
   <!-- /.sidebar -->
</aside>