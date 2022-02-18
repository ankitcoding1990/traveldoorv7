<input type="hidden" name="id" id="terms_id">
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <label>Services</label>
            
                {!! Form::select('service_id', $service, null, ['class' => 'form-control','id' => 'service_name','placeholder' => '--Select Service--']) !!}
        </div>
    </div>
</div>
<center><img class="loader" src="\assets\images\loader.gif" style="width:40%; display:none"/></center>
<div class="row data-div" style="display: none">
    <div class="col-sm-12">
        <div class="form-group">
            <label for="terms_conditions">Terms & Conditions</label>
            <textarea class="ckeditor form-control" name="terms_conditions" id="terms_conditions"></textarea>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="cancel_policy">Cancellation Policy</label>
            <textarea class="ckeditor form-control" name="cancel_policy" id="cancel_policy"></textarea>
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="confirm_msg">Confirmation Message</label>
            <textarea class="ckeditor form-control" name="confirm_msg" id="confirm_msg"></textarea>
        </div>
    </div>
</div>
