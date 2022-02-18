<input type="hidden" name="enquiry_type_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Enquiry Type Name <span class="asterisk">*</span></label>
            {!! Form::text('enquiry_type_name', null, ['class' => 'form-control validate', 'placeholder' => 'Name', 'id' => 'enquiry_type_name','autofocus']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
