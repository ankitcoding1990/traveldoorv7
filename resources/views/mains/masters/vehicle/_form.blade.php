<input type="hidden" name="vehicle_created_by" value="{{auth()->user()->id}}">
<input type="hidden" name="vehicle_created_role" value="{{auth()->user()->users_role}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Vehicle Type <span class="asterisk">*</span></label>
            {!! Form::select('vehicle_type_id', $vehicle_type, null, ['placeholder' => '--Select Vehicle Type--', 'class' => 'form-control select2','id' => 'vehicle_tyoe_id']) !!}
            @error('vehicle_type_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Vehicle Name <span class="asterisk">*</span></label>
            {!! Form::text('vehicle_name', null, ['placeholder' => 'Vehicle Name', 'id' => 'vehicle_name','autofocus', 'class' => 'form-control']) !!}
            {{-- <input type="text" class="form-control" placeholder="Vehicle Name" id="vehicle_name" name="vehicle_name" autofocus> --}}
            @error('vehicle_name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
