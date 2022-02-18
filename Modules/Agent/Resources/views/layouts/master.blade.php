<!DOCTYPE html>
<html lang="en">
  <head>
			<x-theme.head />
			@stack('style')
            <link rel="stylesheet" href="{{ asset('css/service.css')}}">
<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
<link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css'>

	</head>

<body class="hold-transition light-skin sidebar-mini theme-rosegold onlyheader">
    <div class="wrapper">
        <x-agents.navbar :agent="$agent" />
        <div class="content-wrapper">
            <div class="container-full clearfix position-relative">
                <x-agents.aside :agent="$agent" />
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="d-flex align-items-center">
                            <div class="mr-auto">
                                <h3 class="page-title">@yield('title')  </h3>
                                <div class="d-inline-block align-items-center">
                                    <nav>
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                                            <li class="breadcrumb-item" aria-current="page">Home</li>
                                            <li class="breadcrumb-item active" aria-current="page"> My Profile</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                            {{-- <a href="" class="btn btn-sm btn-primary pull-right edit-profile"><i
                                    class="fa fa-pencil"></i> Edit Profile</a> --}}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                           @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

            <x-agents.footer />
</body>

<x-theme.scripts />


<!-- swiper -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js'></script>

<!-- bootstrap time picker -->
<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>

<script src="{{ asset('assets/vendor_components/OwlCarousel2/owl.carousel.js') }}"></script>
	<!-- flexslider -->
<script src="{{ asset('assets/vendor_components/flexslider/jquery.flexslider.js') }}"></script>
<script src="{{ asset('assets/js/pages/slider.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>

@stack('scripts')

</html>
