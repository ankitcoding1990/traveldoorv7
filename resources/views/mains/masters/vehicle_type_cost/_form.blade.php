<input type="hidden" name="vehicle_cost_created_by" value="{{auth()->id()}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Vehicle Type Name <span class="asterisk">*</span></label>
            {!! Form::select('vehicle_type_id', getVehicleTypes()->pluck('vehicle_type_name', 'id') , null, ['autofocus','class' => 'form-control select2 validate', 'id' => 'vehicle_type_name', 'placeholder' => '--Select Vehicle Type--`']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
 <div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Cost/Expenses per 100km <span class="asterisk">*</span></label>
            {!! Form::text('vehicle_type_cost', null , ['class'=> "form-control isNumeric validate", 'placeholder' => "Cost/Expenses per 100km", 'id' => "vehicle_type_cost", 'autofocus' ]) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
