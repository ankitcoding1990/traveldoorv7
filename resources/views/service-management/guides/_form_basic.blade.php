
<div class="row border-bottom p-3">
    <h3 class="m-2">Guide Basic</h3>
    <input type="hidden" name="created_by" value="{{ auth()->check() ? auth()->id() : null }}">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">First Name</label>
          {!! Form::text('guide_first_name', null, ['class' => 'form-control validate', 'placeholder' => 'Guide first name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Last Name</label>
          {!! Form::text('guide_last_name', null, ['class' => 'form-control validate', 'placeholder' => 'Guide last name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Contact Number</label>
          {!! Form::text('guide_contact_number', null, ['class' => 'form-control validate', 'placeholder' => 'Guide contact number']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="supplier">Language</label>
            {!! Form::select('guide_language[]', getLanguages()->pluck('language_name','id'), null, ['class' => 'form-control Select2', 'id' => 'guide_language','placeholder' => '--Select Language--', 'tabindex' => '-1', 'mutiple']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="blackout_days">Blackout Days</label>
            <div class="row">
                <div class="col-sm-4"><button type="button" class="btn btn-success add-blackout-days" style="font-size: 1rem;"><i
                            class="fa fa-plus" aria-hidden="true"></i> Blackout Days</button></div>
                <div class="col-sm-8">
                    {!! Form::text('blackout_days', null, ['class' => 'form-control', 'id' => 'blackout_days','style' =>  isset($activity->blackout) ? "display:block;" : "display:none;",'placeholder' => 'Select Dates', 'autocomplete' => 'off']) !!}
                </div>
            </div>
        </div>
    </div>

    @php
        if(isset($guide)){
            $weekdays = $guide->guide_available_days;
        }
        $operatingWeekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    @endphp
    <div class="col-sm-12">
        <h3 class="m-2">Guide Available Days</h3>
        @foreach ($operatingWeekdays as $key => $operationWeek)
            @php
                $checkOprationWeekYes = 'checked';
                $checkOprationWeekNo = '';
            @endphp
            @isset($guide)
                @php
                    if ($weekdays != null) {
                        if ($weekdays[$operationWeek] == 'yes') {
                            $checkOprationWeekYes = 'checked';
                        }
                        if ($weekdays[$operationWeek] == 'no') {
                            $checkOprationWeekNo = 'checked';
                        }
                    }
                @endphp
            @endisset
            <div class="row">
                <div class="col-md-6">
                    <label>{{ strtoupper($operationWeek) }} <span class="asterisk">*</span></label></div>
                <div class="col-md-6">
                    <input name="activity_available_days[{{ $operationWeek }}]" type="radio"
                        id="week_{{ $operationWeek }}_1" class="with-gap radio-col-primary" value="yes"
                        {{ $checkOprationWeekYes }}>
                    <label for="week_{{ $operationWeek }}_1">Yes </label>
                    <input name="activity_available_days[{{ $operationWeek }}]" type="radio"
                        id="week_{{ $operationWeek }}_2" class="with-gap radio-col-primary" value="no"
                        {{ $checkOprationWeekNo }}>
                    <label for="week_{{ $operationWeek }}_2">No</label>
                </div>
                <div class="invalid-feedback">
                </div>
                @error('operating_weekdays')
                    <p class="text-warning">{{ $message }}</p>
                @enderror
            </div>
        @endforeach
    </div>
    <h3>Guide Cost</h3>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Guide Price <small>(per day)</small></label>
          {!! Form::text('guide_price', null, ['class' => 'form-control validate', 'placeholder' => 'Guide Price']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Guide Food Cost <small>(per day)</small></label>
          {!! Form::text('guide_price', null, ['class' => 'form-control validate', 'placeholder' => 'Guide Food Cost']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Guide Hotel Cost <small>(per day)</small></label>
          {!! Form::text('guide_price', null, ['class' => 'form-control validate', 'placeholder' => 'Guide Hotel Cost']) !!}
        </div>
    </div>
   <h3>Service</h3>
   <div class="col-sm-6">
    <div class="form-group">
        <label for="supplier">Supplier</label>
        {!! Form::select('guide_supplier_id', getSuppliers()->pluck('name','id'), null, ['class' => 'form-select', 'id' => 'supplier','placeholder' => '--Select Supplier--', 'onchange' => 'getCountriesBySuppliers($(this).val())']) !!}
        <small class="invalid-feedback"></small>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label for="country">Country <small>(Acc. to supplier)</small></label>
        {!! Form::select('guide_country_id',[], null, ['class' => 'form-select validate', 'id' => 'country','placeholder' => '--Select Country--', 'onchange' => 'getCitiesByCountry($(this).val())']) !!}
        <small class="invalid-feedback"></small>
    </div>
</div>
<div class="col-sm-6">
    <div class="form-group">
        <label for="city_id">City</label>

        {!! Form::select('guide_city_id', [] ,$activity->city_id ??  null, ['class' => 'form-select validate', 'id' => 'city_id','placeholder' => '--Select City--']) !!}
        <small class="invalid-feedback"></small>
    </div>
</div>
    
   
</div>
