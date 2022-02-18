<div class="art-bg">
    <!-- <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art1.svg" alt="" class="art-img light-img">
    <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art2.svg" alt="" class="art-img dark-img">
    <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art-bg.svg" alt="" class="wave-img light-img">
    <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art-bg2.svg" alt="" class="wave-img dark-img"> -->
</div>
<header class="main-header">
  <!-- Logo -->
  <a href="{{url('supplier-home')}}" class="logo">
    <!-- mini logo -->
   <div class="logo-mini">
      @php 
      $supplier_logo=auth()->guard('supplier')->user()->logo;
      @endphp
        <span class="light-logo"><img src="@if($supplier_logo!="") {{ asset('assets/uploads/supplier_logos') }}/{{$supplier_logo}} @else {{ asset('assets/images/logo-light.png') }} @endif" alt="logo" @if($supplier_logo!="") style="width:90px;height:60px" @endif></span>
        <span class="dark-logo"><img src="" alt="logo"></span>
    </div>
  </a>
  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top">
    <div class="app-menu">

      <ul class="header-megamenu nav">

          <li class="btn-group nav-item">

              <a href="#" class="nav-link rounded" data-toggle="push-menu" role="button">

                  <i class="nav-link-icon mdi mdi-menu text-white"></i>

              </a>

          </li>

          <li class="btn-group nav-item">

              <a href="#" data-provide="fullscreen" class="nav-link rounded" title="Full Screen">

                  <i class="nav-link-icon mdi mdi-crop-free text-white"></i>

              </a>

          </li>

      </ul> 

    </div>

    <div class="navbar-custom-menu r-side">

      <ul class="nav navbar-nav">

        <!-- User Account-->

        <li class="dropdown user user-menu">

          <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">

            <img src="@if($supplier_logo!="") {{ asset('assets/uploads/supplier_logos') }}/{{$supplier_logo}} @else {{ asset('assets/images/user.png')}} @endif" class="user-image rounded-circle" alt="User Image">

          </a>

          <ul class="dropdown-menu animated flipInX">

            <!-- User image -->

            <li class="user-header bg-img" style="background-image: url('{{ asset('assets/images/color-plate/theme-oceansky.jpg')}}')" data-overlay="3">

                <div class="flexbox align-self-center">					  

                    <img src="@if($supplier_logo!="") {{ asset('assets/uploads/supplier_logos') }}/{{$supplier_logo}} @else {{ asset('assets/images/user.png')}} @endif" class="float-left rounded-circle" alt="User Image">					  

                  <h4 class="user-name align-self-center">

                      @if(auth()->guard('supplier')->user())

                      <span>{{ucfirst(auth()->guard('supplier')->user()->name)}}</span>

                      <small>{{auth()->guard('supplier')->user()->email}}</small>

                      @else

                      <span></span>

                      <small></small>

                      @endif

                  </h4>

                </div>

            </li>

            <!-- Menu Body -->

            <li class="user-body">

                  <a class="dropdown-item" href="{{route('supplier.profile.index')}}"><i class="ion ion-person"></i> My Profile</a>

                  <div class="dropdown-divider"></div>

                  <a class="dropdown-item" href="{{route('supplier.logout')}}"><i class="ion-log-out"></i> Logout</a>

            </li>

          </ul>

        </li>	

        <!-- Control Sidebar Toggle Button -->

      </ul>

    </div>

  </nav>

</header>