<input type="hidden" name="service_created_by" value="{{auth()->user()->id}}">
<input type="hidden" name="city_selected" id="city_selected" value="@isset($service->city_id) {{$service->city_id}} @endisset">
<input type="hidden" name="delimage" id="del">
{!! Form::hidden('id', null) !!}
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <label>Service Name<span class="asterisk">*</span></label>
            {!! Form::text('service_name', null, ['class' => 'form-control','id' => 'service_name' ,'placeholder' => 'Name','autofocus']) !!}
            @error('service_name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Country Name <span class="asterisk">*</span></label>
            {!! Form::select('country_id', getCountries(1), null, ['class' => 'form-control select2' ,'id' => 'country_id' ,'placeholder' => '--Select Country--','autofocus']) !!}
            @error('country_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="col-sm-5">
        <div class="form-group">
            <label>City Name <span class="asterisk">*</span></label>
            <select name="city_id" class="form-control select2" id="city_id" autofocus>
                <option disabled selected hidden value>--Select Country--</option>
            </select>
            @error('city_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Service Type <span class="asterisk">*</span></label>
            {!! Form::select('service_type', ['1' => 'Extra Service','2' => 'Services Operator'], null, ['class' => 'form-control','id' => 'service_type' ,'placeholder' => '--Select Service--','autofocus']) !!}
            @error('service_type')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>No. Of Pax/Service <span class="asterisk">*</span></label>
            {!! Form::text('price_per_pax', null, ['class' => 'form-control','id' => 'price_per_pax' ,'placeholder' => 'Per Pax Price','autofocus']) !!}
            @error('price_per_pax')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Price <small>(per service)</small> <span class="asterisk">*</span></label>
            {!! Form::text('price_per_service', null, ['class' => 'form-control','id' => 'price_per_service' ,'placeholder' => 'Price','autofocus']) !!}
            @error('price_per_service')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Service Description <small>(per service)</small> <span class="asterisk">*</span></label>
            {!! Form::textarea('service_description', null, ['class' => 'form-control','id' => 'service_description' ,'placeholder' => 'Description','rows' => '1','autofocus']) !!}
            @error('service_description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Picture For Service <small>(per service)</small> <span class="asterisk">*</span></label>
            {!! Form::file('service_image',['class' => 'form-control','id' => 'service_image','accepts' => 'images/*','autofocus']) !!}
        </div>
        @isset($service)
            @if($service->service_image)
            <div class="form-group">
                <label>Previous Uploaded Image</label><button type="button" class='btn pull-right' onclick='remdiv($(this),"{{$service->service_image}}")'><span class="h3">&times;</span></button><br/>
                <img src="{{$service->service_image}}" alt="Service">
            </div>
            @else
            <div style="text-align:center">
                <div class="text-primary" style="font-size: 3rem;"><i class="fa fa-close" aria-hidden="true"></i></div>
                <label class="text-danger">No Previous Uploaded Image</label>
            </div>
            @endif
        @endisset
        @error('service_image')
            <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>
