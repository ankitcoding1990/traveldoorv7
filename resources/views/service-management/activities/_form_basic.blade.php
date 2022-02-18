@push('style')
<style>
    .smaller{
        font-size: smaller;
    }
</style>
@endpush
{{-- @dd(auth()->guard('supplier')->user()->id) --}}
<div class="row border-bottom p-3">
    <h3 class="m-2">Activity Basic</h3>
    <input type="hidden" name="created_user_id" value="{{ auth()->check() ? auth()->id() : null }}">
    <input type="hidden" name="created_supplier_id" value="{{ auth()->guard('supplier')->check() ? auth()->guard('supplier')->id() : null  }}">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Activity type</label>
            {!! Form::select('activity_type_id', getActivityTypes()->pluck('activity_type_name', 'id'), null, ['class' => 'form-select validate select2', 'id' => 'type']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="name">Name</label>
            {!! Form::text('name', null, ['class' => 'form-control validate isAlpaNumeric', 'id' => 'name', 'placeholder' => 'Activity Name']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="supplier">Supplier</label>
            {!! Form::select('supplier_id', getSuppliers()->pluck('name', 'id'), auth()->guard('supplier')->user()->id ?? null, ['class' => 'form-select select2', 'id' => 'supplier', 'placeholder' => '--Select Supplier--', 'onchange' => 'getCountriesBySuppliers($(this).val())', auth()->guard('supplier')->check() ? 'disabled' : '']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="location">Location</label>
            {!! Form::text('location', null, ['class' => 'form-control validate isAlpaNumeric', 'id' => 'location', 'placeholder' => 'Location']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="country">Country <span class="smaller">(Acc. to supplier)</span></label>
            {!! Form::select('country_id', [], null, ['class' => 'form-select validate select2', 'id' => 'country', 'placeholder' => '--Select Country--', 'onchange' => 'getCitiesByCountry($(this).val())']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="city_id">City</label>

            {!! Form::select('city_id', [], $activity->city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'city_id', 'placeholder' => '--Select City--']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="duration">Duration <small>(in hrs.)</small></label>
            {!! Form::text('duration', null, ['class' => 'form-control validate', 'id' => 'duration', 'placeholder' => 'Activity Duration']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="valid_from">Valid <small>(From)</small></label>
            {!! Form::text('valid_from', null, ['class' => 'form-control datepicker-future validate', 'id' => 'valid_from', 'placeholder' => 'Valid From Date', 'autocomplete' => 'off']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="valid_to">valid <small>(To)</small></label>
            {!! Form::text('valid_to', null, ['class' => 'form-control datepicker-future validate', 'id' => 'valid_to', 'placeholder' => 'Valid To Date', 'autocomplete' => 'off']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="time_from">Time <small>(From)</small></label>
            <div class="bootstrap-timepicker">
                <div class="input-group">
                    {!! Form::text('time_from',isset($model) ? TwelveHourTime($model->time_from) : null, ['class' => 'form-control validate timePicker', 'id' => 'time_from', 'placeholder' => 'Valid From Time', 'autocomplete' => 'off']) !!}
                    <small class="invalid-feedback"></small>
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            <label for="time_to">Time <small>(To)</small></label>
            <div class="bootstrap-timepicker">
                <div class="input-group">
                    {!! Form::text('time_to', isset($model) ? TwelveHourTime($model->time_to) : null, ['class' => 'form-control validate timePicker', 'id' => 'time_to', 'placeholder' => 'Valid To Time', 'autocomplete' => 'off']) !!}
                    <small class="invalid-feedback"></small>
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="currency">Currency</label>
            {!! Form::select('currency', activeCurrencies()->pluck('full_name','id'), null, ['class' => 'form-select validate select2', 'id' => 'currency']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="blackout_days">Blackout Days</label>
            <div class="row">
                <div class="col-sm-4"><button type="button" class="btn btn-success add-blackout-days"
                        style="font-size: 1rem;"><i class="fa fa-plus" aria-hidden="true"></i> Blackout
                        Days</button></div>
                <div class="col-sm-8">
                    {!! Form::text('blackout_days', null, ['class' => 'form-control', 'id' => 'blackout_days', 'style' => isset($activity->blackout) ? 'display:block;' : 'display:none;', 'placeholder' => 'Select Dates', 'autocomplete' => 'off']) !!}
                </div>
            </div>
        </div>
    </div>

    @php
        if (isset($activity)) {
            $weekdays = $activity->activity_available_days;
        }
        $operatingWeekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    @endphp
    <div class="col-sm-12">
        <h3 class="mb-3">Activity Available Days</h3>
        @foreach ($operatingWeekdays as $key => $operationWeek)
            @php
                $checkOprationWeekYes = 'checked';
                $checkOprationWeekNo = '';
            @endphp
            @isset($activity)
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
                <div class="col-md-2 col-5">
                    <label class="mb-2">{{ strtoupper($operationWeek) }} <span
                            class="asterisk">*</span></label>
                </div>
                <div class="col-md-10 col-7">
                    <input name="activity_available_days[{{ $operationWeek }}]" type="radio"
                        id="week_{{ $operationWeek }}_1" class="with-gap radio-col-primary" value="yes"
                        {{ $checkOprationWeekYes }}>
                    <label class="mr-4 mb-2" for="week_{{ $operationWeek }}_1">Yes </label>
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
    <div class="col-sm-6">
        <div class="form-group">
            <h3>Booking Type</h3>
            <input type="radio" id="single" class="with-gap radio-col-primary" name="booking_type" value="single"
                checked>
            <label for="single">Single</label>
            <input type="radio" id="group" class="with-gap radio-col-primary" name="booking_type" value="group">
            <label for="group">Group</label>
        </div>
        @error('booking_type')
            <small class="text-warning">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <h3>Age Groups</h3>
            @php
                if (isset($activity)) {
                    $adult = $activity->age_groups['adult']['allowed'];
                    $child = $activity->age_groups['child']['allowed'];
                    $infant = $activity->age_groups['infant']['allowed'];
                }
            @endphp
            <div class="row">
                <div class="col-sm-4 seprate">
                    <input type="checkbox" id="adults_age" class="check-box adult" name="age_groups[adult][allowed]"
                        value="Yes" {{ isset($adult) && $adult == 'Yes' ? 'checked' : '' }}>
                    <label for="adults_age">Adults</label>
                    <div class="row adult-column"
                        style="{{ isset($adult) && $adult == 'Yes' ? '' : 'display:none' }}">
                        <div class="col-sm-6">
                            <label>Min Age</label>
                            {!! Form::text('age_groups[adult][min_age]', null, ['class' => 'form-control isNumeric', 'id' => 'min_age']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>Max Age</label>
                            {!! Form::text('age_groups[adult][max_age]', null, ['class' => 'form-control isNumeric', 'id' => 'max_age']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 seprate">
                    <input type="checkbox" id="child_age" class="check-box child" name="age_groups[child][allowed]"
                        value="Yes" {{ isset($child) && $child == 'Yes' ? 'checked' : '' }}>
                    <label for="child_age">Child</label>
                    <div class="row child-column"
                        style="{{ isset($child) && $child == 'Yes' ? '' : 'display:none' }}">
                        <div class="col-sm-6">
                            <label>Min Age</label>
                            {!! Form::text('age_groups[child][min_age]', null, ['class' => 'form-control isNumeric', 'id' => 'min_age']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>Max Age</label>
                            {!! Form::text('age_groups[child][max_age]', null, ['class' => 'form-control isNumeric', 'id' => 'max_age']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <input type="checkbox" id="infant_age" class="check-box infant" name="age_groups[infant][allowed]"
                        value="Yes" {{ isset($infant) && $infant == 'Yes' ? 'checked' : '' }}>
                    <label for="infant_age">Infant</label>
                    <div class="row infant-column"
                        style="{{ isset($infant) && $infant == 'Yes' ? '' : 'display:none' }}">
                        <div class="col-sm-6">
                            <label>Min Age</label>
                            {!! Form::text('age_groups[infant][min_age]', null, ['class' => 'form-control isNumeric', 'id' => 'min_age']) !!}
                        </div>
                        <div class="col-sm-6">
                            <label>Max Age</label>
                            {!! Form::text('age_groups[infant][max_age]', null, ['class' => 'form-control isNumeric', 'id' => 'max_age']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
@isset($activity)
    <script>
    $(function() {
            var supplier_id = $('#supplier').val()
            if(supplier_id != null)
            {
                getCountriesBySuppliers(supplier_id, '{{ $activity->country_id }}');
                getCitiesByCountry('{{ $activity->country_id }}', '{{ $activity->city_id }}');
            }
        })
    </script>
@endisset
@if (auth()->guard('supplier')->check())
<script>
    $(function(){
        getCountriesBySuppliers('{{ auth()->guard("supplier")->user()->id }}');
    })
</script>
@endif
    <script>

        google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
            });
        }

        $(document).on('click', '.add-blackout-days', function() {
            $('#blackout_days').toggle();
        })
        function getCountriesBySuppliers(supplierId, countryId = null) {
            var options = '<option>--Select Country--</option>';
            $.ajax({
                type: 'get',
                url: '{{ url('get-supplier-country') }}',
                data: {
                    'supplier_id': supplierId
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        if (key == countryId) {
                            options += `<option value='${key}' selected >${value}</option>`;
                        }
                        options += `<option value='${key}'>${value}</option>`;
                    });

                    $('#country').html(options);
                }
            })
        }

        function getCitiesByCountry(countryId, cityId = null) {
            var options = '<option>--Select City--</option>';
            $.ajax({
                type: 'get',
                url: '{{ url('getcities') }}',
                data: {
                    'country': countryId
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        if (key == cityId) {
                            options += `<option value='${key}' selected >${value}</option>`;
                        }
                        options += `<option value='${key}'>${value}</option>`;
                    });
                    $('#city_id').html(options);
                }
            })
        }

        $(document).on('click', '.check-box', function() {
            if ($(this).hasClass('adult')) {
                $('.adult-column').toggle()
                if ($(this).siblings('div').children('.col-sm-6').find('input').hasClass('validate'))
                    $(this).siblings('div').children('.col-sm-6').find('input').removeClass('validate')
                else
                    $(this).siblings('div').children('.col-sm-6').find('input').addClass('validate')
            }
            if ($(this).hasClass('child')) {
                $('.child-column').toggle()
                if ($(this).siblings('div').children('.col-sm-6').find('input').hasClass('validate'))
                    $(this).siblings('div').children('.col-sm-6').find('input').removeClass('validate')
                else
                    $(this).siblings('div').children('.col-sm-6').find('input').addClass('validate')
            }
            if ($(this).hasClass('infant')) {
                $('.infant-column').toggle()
                if ($(this).siblings('div').children('.col-sm-6').find('input').hasClass('validate'))
                    $(this).siblings('div').children('.col-sm-6').find('input').removeClass('validate')
                else
                    $(this).siblings('div').children('.col-sm-6').find('input').addClass('validate')
            }
        })


    </script>
@endpush
