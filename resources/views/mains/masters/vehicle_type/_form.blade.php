<div class="row mb-10" >
<h5 style="color:red" id="vehicle_type_error"></h5>
</div>
<input type="hidden" name="vehicle_type_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Vehicle Type Name <span class="asterisk">*</span></label>
            {!! Form::text('vehicle_type_name', null, ['class' => 'form-control validate', 'id' => 'vehicle_type_name','placeholder' => 'Name', 'autofocus']) !!}
            @error('vehicle_type_name')
              <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
     <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Minimum Passengers <span class="asterisk">*</span></label>
            {!! Form::text('vehicle_type_min', null , ['class' => 'form-control isNumeric validate', 'id' => 'vehicle_type_min','autofocus','placeholder' => 'Minimumm Passengers']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
     <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Maximum Passengers <span class="asterisk">*</span></label>
            {!! Form::text('vehicle_type_max', null , ['class' => 'form-control isNumeric validate', 'id' => 'vehicle_type_max','autofocus','placeholder' => 'Maximum Passengers']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
     <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Vehicle Type Image</label>
            <input type="file" accept="image/*" class="form-control {{ isset($vehicle) ? '' : 'validate'}}" id="vehicle_type_image" name="vehicle_type_image">
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
