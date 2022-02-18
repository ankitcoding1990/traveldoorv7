@php
$supplier = auth()
    ->guard('supplier')
    ->user();
$services = $supplier->services;
$contactPerson = $supplier->contactPerson;
$bankDetails = $supplier->bankDetails;
$country = $supplier->country;
$city = $supplier->city;
// $oprCountries = $supplier->operateCountries();
// $oprCurrency = $supplier->operateCurrency();
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
			<x-theme.head />
			<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
      @stack('style')
	</head>


<body class="hold-transition light-skin sidebar-mini theme-rosegold onlyheader">
    <div class="wrapper">
        <x-suppliers.navbar :agent="$supplier" />
        <div class="content-wrapper">
            <div class="container-full clearfix position-relative">
                <x-suppliers.aside :supplier="$supplier" />
                <div class="content">
                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                        <div class="d-flex">
                            <div>
                                <h3 class="page-title">@yield('title') </h3>
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a>
                                        </li>
                                        <li class="breadcrumb-item" aria-current="page">Home</li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="ms-auto">
                                @yield('breadcrumb-button')
                            </div>
                        </div>
                        {{-- <a href="" class="btn btn-sm btn-primary pull-right edit-profile"><i
                                    class="fa fa-pencil"></i> Edit Profile</a> --}}
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
    <x-suppliers.footer />
</body>

<x-theme.scripts />

<!-- Bootstrap Clock Picker -->
<script src="{{ asset('assets/vendor_plugins/clockpicker/dist/bootstrap4-clockpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
{{-- <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/js/pages/data-table.js') }}"></script> --}}

<script src="{{ asset('assets/vendor_components/OwlCarousel2/owl.carousel.js') }}"></script>
<!-- flexslider -->
<script src="{{ asset('assets/vendor_components/flexslider/jquery.flexslider.js') }}"></script>
<script src="{{ asset('assets/js/pages/slider.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>


</html>
