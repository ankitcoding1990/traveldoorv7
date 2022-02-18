@extends('mains.agents.show')

@section('profile')

{!! Form::open(['method' => 'put', 'route' => ['passwordchange.update',$id], 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
{{-- import form --}}
@include('common.password._form-inputs',['type' => 'agent','admin' => true])
{{-- /Import form --}}
<button type="submit" id="update_password" class="btn btn-primary">Update</button>
{!! Form::close() !!}

<script>
    $(document).on('keyup','#ConfirmPassword',function () {  
        var password         = $('#password').val();
        var confirmPassword  = $(this).val();
        if(password != confirmPassword) {
            $(this).css('border','red 1px solid');
            $('#update_password').prop('disabled',true);
            if ($(this).next().find('small').length == 0) {
                $(this).next().append("<small class='confirm_has_error'>Confirm Password Didn't Match With Password</small>");
            }
        } else {
            $(this).css('border','1px solid #9e9e9e');
            $('#update_password').prop('disabled',false);
            if ($(this).next().find('small').length != 0) {
                $(this).next().find('.confirm_has_error').remove();
            }
        }
    });
</script>
@endsection
