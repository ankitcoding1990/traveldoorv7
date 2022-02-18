
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
	  <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="author" content="">
    <title>@yield('title') | Travel CRM</title>
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendor_components/datatable/datatables.min.css') }}"/> --}}
	  <link rel="stylesheet" href="{{ asset('assets/vendor_components/select2/css/select2.min.css') }}">
	  <link rel="stylesheet" href="{{ asset('assets/ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css') }}">

  {{-- =================agent files====================== --}}
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <link href="{{ asset('assets/vendor_plugins/bootstrap-slider/slider.css') }}">
  <link href="{{ asset('assets/vendor_components/OwlCarousel2/assets/owl.carousel.css' ) }}">
  <link href="{{ asset('assets/vendor_components/OwlCarousel2/assets/owl.theme.default.css' ) }}">
  <!-- flexslider-->
	<link rel="stylesheet" href="{{ asset('assets/vendor_components/flexslider/flexslider.css') }}">
	{{-- <link rel="stylesheet" href="{{ asset('assets/vendor_plugins/clockpicker/dist/bootstrap4-clockpicker.min.css') }}"> --}}
  <style>
    .main-sidebar
    {
     background: -webkit-linear-gradient(-55deg, #234076 35%, #e2dcff 100%);
      border-radius: 10px;
      border: none;
    }
    .sidebar-menu li > a {
      color:white !important;
      font-weight: 600;
      font-size:15px;
    }
    .sidebar-menu > li > a > i {
     color:white !important;
      font-size:15px;
   }
   .sidebar-menu > li.active {
      background-color: #192787;
  }
  .custom-breadcrumb-button{
    float: right;
    position: relative;
    top: -1em!important;
    right: 1em!important;
  }

  /* .custom-breadcrumb{
    display: inline-block;
    width: 100%;
  }

  .main-sidebar{
        top:0px !important;
        border-top-left-radius: 0 !important;
        border-top-right-radius: 0 !important;
      } */
  </style>
  {{-- /=====================agent files=============================== --}}
    <!-- sweet alert cdn -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap/css/bootstrap.css') }}">
	  <!-- bootstrap datepicker -->
   <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
  <!-- bootstrap datetimepicker -->
	<link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
	<!-- Bootstrap time Picker -->
	<link rel="stylesheet" href="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}">
	<!-- daterange picker -->
	<link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/vendor_components/bootstrap-select/css/bootstrap-select.css') }}">
	<link href="{{ asset('assets/vendor_components/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
	<!-- c3 CSS -->
	<!-- jQuery cdn -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

	<!-- toast CSS -->
	<link href="{{ asset('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.css') }}">
	<!-- theme style -->
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<!-- VoiceX Admin skins -->
  <link rel="stylesheet" href="{{ asset('assets/css/common.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/skin_color.css') }}">

	<link rel="stylesheet" href="{{ asset('assets/intl-tel-input-master/build/css/intlTelInput.css') }}">
  <!-- toaster -->
  <link rel="stylesheet" href="{{ asset('assets/toast/build/toastr.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- datatable buttons -->
  {{-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css"> --}}

  {{-- datatable latest --}}
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="{{asset('assets/css/services.css')}}">
<script type="text/javascript">




  function baseUrl(){
    return '{{ url('/') }}';
  }
  function csrfToken(){
    return '{{ csrf_token() }}';
  }
</script>
