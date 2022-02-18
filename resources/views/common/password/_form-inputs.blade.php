<div class="row">
    <div class="col-md-12 contact_div" id="contact_div_1">
        <div class="row mt-20">
            @csrf
            @isset($isAdmin)
                <div class="col-sm-6 col-md-6 ">
                    <div class="form-group">
                        <label>Old Password <span class="asterisk">*</span>
                        </label>
                        {!! Form::password('oldPassword', ['class' => 'form-control', 'placeholder' => 'Old Password','id' => 'oldPassword']) !!}
                        <div class="invalid-feedback d-block">
                        </div>
                    </div>
                </div>
            @endisset
            
            @isset($admin)
                <input type="hidden" name="admin" value="true">
            @endisset
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label>New Password <span class="asterisk">*</span></label>
                    <input type="hidden" name="type" value="{{$type}}">
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'New Password','id' => 'password']) !!}
                    <div class="invalid-feedback d-block">

                    </div>
                </div>      
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label>Confirm New Password <span class="asterisk">*</span></label>
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm New Password', 'id' => 'ConfirmPassword']) !!}
                        <div class="invalid-feedback d-block">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>