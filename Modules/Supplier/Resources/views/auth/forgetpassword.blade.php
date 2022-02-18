@extends('supplier::layouts.auth')
@section('title', 'Agent Login')
@section('main')
<div class="px-30 pb-30">
        <form id="forgetpasswordForm" action="{{ route('agent.forget-password') }}" onsubmit="forgetPassword($(this))" method="post">
            {{ csrf_field() }}
            <h3 class="text-center login-h3">Forget Password</h3>
            <p id="forgetpass-form-message"></p>
            {{-- Email  --}}
            <div class="form-group">
                <div class="input-group mb-25">
                    <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-transparent"><i class="ti-envelope"></i></span>
                    </div>
                    <input id="email_id" type="email" class="form-control pl-15 bg-transparent  plc-white"
                        placeholder="Enter Your Email Address" name="email">
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
@push('forget_password_script')
<script>
    // Forget Password Ajax
    function forgetPassword(form){
      event.preventDefault();
      loader();
      $.ajax({
        url : form.attr('action'),
        type : form.attr('method'),
        data : form.serialize(),
        success : function(response){
                  //formInputErrorsClear(form);
          if (response.status == true) {
            $('#forgetpass-form-message').removeClass('alert alert-danger').addClass('alert alert-success').html('<i class="fas fa-check"></i>' + response.message);
          }else{
            $('#forgetpass-form-message').addClass('alert alert-danger').html('<i class="fas fa-exclamation-triangle"></i>' + response.message);
          }
          loader(false);
          $('#forgetpasswordForm')[0].reset();
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
