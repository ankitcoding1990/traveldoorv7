<div class="row">
    <div class="col-md-10">
        <h4 class="">Change Password</h4>
    </div>
    <hr>
</div>
<div id="agent-contacts">
  <div class="box">
    <div class="box-body">
        <div class="row">
        {!! Form::open(['method' => 'put', 'route' => ['passwordchange.update',$model->id], 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
            {{-- import form --}}
            @include('common.password._form-inputs',['isAdmin' => true])
            {{-- /Import form --}}
        <button type="submit" id="update_password" class="btn btn-primary">Update</button>
        {!! Form::close() !!}
        </div>
    </div>
  </div>
</div>

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

    $(document).on('keyup','#password',function () {  
        var oldPassword = $('#oldPassword').val();
        var password    = $(this).val();
        var confirmPassword  = $('#ConfirmPassword').val();
        if(password == oldPassword) {
            $(this).css('border','red 1px solid');
            $('#update_password').prop('disabled',true);
            if ($(this).next().find('small').length == 0) {
                $(this).next().append("<small class='confirm_has_error'>New Password Cannot be same as old password</small>");
            }
        } else {
            $(this).css('border','1px solid #9e9e9e');
            $('#update_password').prop('disabled',false);
            if ($(this).next().find('small').length != 0) {
                $(this).next().find('.confirm_has_error').remove();
            }
        }
        if(password != confirmPassword) {
            $('#update_password').prop('disabled',true);
        }
    });

</script>