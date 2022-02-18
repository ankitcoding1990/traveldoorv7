<input type="hidden" name="hotel_type_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Hotel Type Name <span class="asterisk">*</span></label>
            {!! Form::text('hotel_type_name', null, ['class' => 'form-control validate', 'id' => 'hotel_type_name', 'placeholder' => 'Name', 'autofocus']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
