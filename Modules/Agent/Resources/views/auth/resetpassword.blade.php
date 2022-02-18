@extends('agent::layouts.auth')
@section('title', 'Agent Login')
@section('content')
<div class="px-30 pb-30">
        <form id="resetpasswordForm" action="{{ route('agent.reset-password') }}" onsubmit="resetPassword($(this))" method="post">
            {{ csrf_field() }}
            <h3 class="text-center login-h3">Reset Password</h3>
            <p id="forgetpass-form-message"></p>
            @isset($tokenFromMail)
                <input type="hidden" name="email_token" value="{{ $tokenFromMail }}">
            @endisset
            {{-- Email  --}}
            <div class="form-group">
                <div class="input-group mb-25">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-transparent"><i class="ti-lock"></i></span>
                    </div>
                    <input id="new_password" type="password" class="form-control pl-15 bg-transparent  plc-white"
                        placeholder="Enter New Password" name="password">
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-25">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-transparent"><i class="ti-lock"></i></span>
                    </div>
                    <input id="re_password" type="password" class="form-control pl-15 bg-transparent  plc-white"
                        placeholder="Retype New Password" name="password_confirmation">
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
            {{-- /Email --}}

            <div class="row">
                <div class="col-12 text-center">
                    <button type="submit" id="forget_password" class="btn btn-warning btn-outline mt-10 log-signin">Continue</button>
                </div>


            </div>
        </form>
    </div>
@endsection
@push('reset_password_script')
<script>
    // Forget Password Ajax
    function resetPassword(form){
      event.preventDefault();
      $.ajax({
        url : form.attr('action'),
        type : form.attr('method'),
        data : form.serialize(),
        success : function(response){
          if (response.status == true) {
            $('#forgetpass-form-message').removeClass('alert alert-danger').addClass('alert alert-success').html('<i class="fas fa-check"></i>' + response.message);
            setTimeout(function(){
						window.location.href = response.redirect;
					}, 1500);
          }else{
                      $('#forgetpass-form-message').addClass('alert alert-danger').html('<i class="fas fa-exclamation-triangle"></i>' + response.message);
          }
        },
        error : function(error){
                  if (typeof error.responseJSON.errors == 'object') {
              formInputErrors(form, error.responseJSON.errors);
          }else if(typeof error.responseJSON.message == 'string'){
                      formInputErrorsClear(form);
                      $('#forgetpass-form-message').removeClass('d-none').addClass('alert alert-danger').html('<i class="fas fa-exclamation-triangle"></i>' + error.responseJSON.message);
                      setTimeout(function(){
                          $('#forgetpass-form-message').addClass('d-none');
                      },1500);
          }
            }

      })
    }
  </script>
@endpush
