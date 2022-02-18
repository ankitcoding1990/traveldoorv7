<input type="hidden" name="sub_amenities_created_by" value="{{auth()->id()}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Main Amenity <span class="asterisk">*</span></label>
            {!! Form::select('amenities_id',getActiveAmenities()->pluck('amenities_name','id'), null , ['id' => "amenities_id", 'class' => 'form-control select2 validate','autofocus', 'placeholder' => '--Select Amenity--']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Sub Amenities Name <span class="asterisk">*</span></label>
            {!! Form::text('sub_amenities_name', null, ['class' => 'form-control validate', 'id' => 'sub_amenities_name', 'autofocus', 'placeholder' => 'Name']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
