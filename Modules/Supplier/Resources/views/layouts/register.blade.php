<!DOCTYPE html>
<html lang="en">
  <head>
			<x-theme.head />
			@stack('style')
	</head>
	<body class="hold-transition theme-fruit bg-img" >
		<x-loader />
		<div class="wrapper">
			<div class="bg-white">
				<div class="container">
					{{-- header --}}
					<div class="content-top-agile srl-navbar">
						<div class="srl-logo text-left">
							<img src="https://crm.traveldoor.ge/assets/images/logo-travel.png" class="logo-travel-img">

						</div>
						<div class="text-right">
							<a href="{{ route('supplier.login') }}">Login</a>
						</div>
					</div>
					{{-- /header --}}
				</div>
			</div>
			<div class="content">
	      <div class="container">
	      		<div class="row align-items-center justify-content-md-center h-p100">
	      			<!--</div>-->
	      			<div class="col-xl-12 col-md-12 col-12">
								<div class="login-form">
									{{--  content --}}
									@yield('content')
									{{--  /content --}}
	  						</div>
	  					</div>
	      		</div>
	      	</div>
			</div>
		</div>
	</body>
	<x-theme.scripts />
	@stack('scripts')
</html>
