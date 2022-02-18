{{-- top nav --}}
<div class="art-bg">
 <!--  <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art1.svg" alt="" class="art-img light-img">

    <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art2.svg" alt="" class="art-img dark-img">

    <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art-bg.svg" alt="" class="wave-img light-img">

    <img src="https://adminvoice-admin-template.multipurposethemes.com/images/art-bg2.svg" alt="" class="wave-img dark-img"> -->
  </div>
  <header class="main-header">

    <!-- Logo -->

    <a href="javascript:;" class="logo">

      <!-- mini logo -->

    <div class="logo-mini">

      <span class="light-logo"> <img src="{{ asset('assets/images/traveldoor-white-logo.png') }}" alt="logo" style="width:100px;height:60px; object-fit:contain;margin-left: 5px;"></span>

      <span class="dark-logo"><img src="" alt="logo"></span>

    </div>

      <!-- logo-->

      <div class="logo-lg">

      <span class="light-logo"><!-- <img src="{{ asset('assets/images/logo-light-text.png') }}" alt="logo"> --></span>

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

      @isset($notifications)
      @if($notifications['permission']=='allowed')
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Notifications">
              <i class="mdi mdi-bell"></i>
            </a>
            <ul class="dropdown-menu animated bounceIn">
              <li class="header">
              <div class="p-20">
                <div class="flexbox">
                  <div>
                    <h4 class="mb-0 mt-0">Notifications</h4>
                    <h4 class="mb-0 mt-0">Enquiries</h4>
                    <h4 class="mb-0 mt-0">Special Offer Enquiries</h4>
                    <h4 class="mb-0 mt-0">Tour Enquiries</h4>
                  </div>
                  <div>
                    <a href="#" class="text-danger">Clear All</a>
                  <h4 class="mb-0 mt-0">{{$notifications['enquiries'] ?? 0}}</h4>
                  <h4 class="mb-0 mt-0">{{$notifications['special_offers_inquiry'] ?? 0}}</h4>
                  <h4 class="mb-0 mt-0">{{$notifications['tour_enquiry'] ?? 0}}</h4>
                  </div>
                </div>
              </div>
              </li>
            </ul>
        </li>
      @endif
      @endisset

      <!-- User Account-->

          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="User">
              <img src="{{ asset('assets/images/user.png')}}" class="user-image rounded-circle" alt="User Image">
            </a>
            <ul class="dropdown-menu animated flipInX">

              <!-- User image -->

              <li class="user-header bg-img" style="background-image: url('{{ asset('assets/images/color-plate/theme-oceansky.jpg')}}')" data-overlay="3">

          <div class="flexbox align-self-center">

            <img src="{{ asset('assets/images/user.png')}}" class="float-left rounded-circle" alt="User Image">

          <h4 class="user-name align-self-center">

            @if (auth()->guard('supplier')->check())
              <span>{{ucwords(auth()->guard('supplier')->user()->name)}}</span>

              <small>{{auth()->guard('supplier')->user()->email}}</small>
            @endif

          </h4>

          </div>

              </li>

              <!-- Menu Body -->
              @if (auth()->check())
                <li class="user-body">

                  <a class="dropdown-item" href="javascript:void(0)"><i class="ion ion-person"></i> My Profile</a>
                 <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{route('logout')}}"><i class="ion-log-out"></i> Logout</a>
                  {{-- <a class="dropdown-item" href=""><i class="ion-log-out"></i> Change Password</a>
                  <div class="dropdown-divider"></div> --}}
                  <div class="p-10">
                    <a href="{{route('user.profile', encrypt(auth()->id()))}}" class="btn btn-sm btn-rounded btn-success">View Profile</a>
                  </div>

                </li>
              @endif


            </ul>

          </li>





          <!-- Control Sidebar Toggle Button -->

     <!--      <li>

            <a href="#" data-toggle="control-sidebar" title="Setting"><i class="fa fa-cog fa-spin"></i></a>

          </li> -->



        </ul>

      </div>

    </nav>

  </header>
{{-- /top nav --}}
