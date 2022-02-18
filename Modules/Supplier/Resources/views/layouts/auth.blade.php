<!DOCTYPE html>
<html lang="en">
  <head>
			<x-theme.head />
			@stack('style')

			<style>
			.sll-logo img{
				width: 130px!important;
				height: auto!important;
			}
			</style>

	</head>
<body class="hold-transition theme-fruit bg-img body-bg-img"  data-gr-c-s-loaded="true">
	<x-loader />
	<div class="wrapper">
		<div class="content">
      <div class="h-p100 container">
      		<div class="row align-items-center justify-content-md-center h-p100">
      			<!--</div>-->
      			<div class="col-xl-4 col-lg-5 col-md-6 col-12">
							<div class="login-form">
								<div class="content-top-agile">
									<div class="sll-logo">
										<img src="https://crm.traveldoor.ge/assets/images/logo-travel.png" class="logo-travel-img">
									</div>

								</div>
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

@stack('forget_password_script')
@stack('reset_password_script')

</html>

<script>
  // login Ajax
  function authLogin(form){
    event.preventDefault();
    $.ajax({
      url : form.attr('action'),
      type : form.attr('method'),
      data : form.serialize(),
      success : function(response){
				console.log(response);
				formInputErrorsClear(form);
        if (response.status == true) {
          $('#login-form-message').removeClass('alert alert-danger').addClass('alert alert-success').html('<i class="fas fa-check"></i>' + response.message);
					setTimeout(function(){
						window.location.href = response.redirect;
					}, 1500);
        }else{
					$('#login-form-message').addClass('alert alert-danger').html('<i class="fas fa-exclamation-triangle"></i>' + response.message);
        }
      },
      error : function(error){
				if (typeof error.responseJSON.errors == 'object') {
            formInputErrors(form, error.responseJSON.errors);
        }else if(typeof error.responseJSON.message == 'string'){
					formInputErrorsClear(form);
					$('#login-form-message').removeClass('d-none').addClass('alert alert-danger').html('<i class="fas fa-exclamation-triangle"></i>' + error.responseJSON.message);
					setTimeout(function(){
						$('#login-form-message').addClass('d-none');
					},1500);
        }
  		}

    })
  }
</script>
