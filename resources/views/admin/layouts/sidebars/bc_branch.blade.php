

<nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">

<div class="position-sticky">
<a class="navbar-brand" href="#" class='py-2'>
<img src="https://firebasestorage.googleapis.com/v0/b/dynamic-links-6ef1c.appspot.com/o/bike%20cafe%20logo_page-0001.jpeg?alt=media&token=693e6b2a-9e64-4fa3-8ca5-211036c1846a" width="80" height="80" alt="">
</a>
  <div class="list-group list-group-flush mx-3 mt-4">
    {{-- <a
      href="{{ url('/admin-login-posts') }}"
      class="list-group-item list-group-item-action py-2 ripple"
      aria-current="true"
    >
      <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
    </a> --}}
  
    <a href="{{ url('/admin/vendor') }}" class="list-group-item list-group-item-action py-2  }}">
      <i class="fas fa-chart-area fa-fw me-3"></i><span>Vendor</span>
    </a>

    <a href="{{ url('/admin/users') }}" class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-lock fa-fw me-3"></i><span>Users</span></a
    >
    <a href="{{ url('/admin/banner') }}" class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-lock fa-fw me-3"></i><span>Banners</span></a
    >
    <a href="{{ url('/admin/transaction') }}" class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-chart-line fa-fw me-3"></i><span>Transactions</span></a
    >
    <a href="{{ url('/admin/help&suppot') }}" class="list-group-item list-group-item-action py-2 ripple">
      <i class="fas fa-chart-pie fa-fw me-3"></i><span>Help & Support</span>
    </a>
    <a href="{{ url('/admin/bcbranch') }}" class="list-group-item list-group-item-action py-2 ripple active"
      ><i class="fas fa-chart-bar fa-fw me-3"></i><span>BC Branch</span></a
    >
    <a href="{{ url('/admin/cancel/orders') }}" class="list-group-item list-group-item-action py-2 ripple ">
      <i class="fas fa-chart-pie fa-fw me-3"></i><span>Cancel orders</span>
    </a>
    

    <a href="{{ url('/logout') }}" class="list-group-item list-group-item-action py-2 ripple"
      ><i class="fas fa-money-bill fa-fw me-3"></i><span>LogOut</span></a
    >
  
  </div>
</div>
</nav>