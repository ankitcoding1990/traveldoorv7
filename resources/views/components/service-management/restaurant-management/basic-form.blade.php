@extends($layout)

@if (isset($restaurant))
    @section('title','Edit Restaurant')
@else
    @section('title','Create Restaurant')    
@endif



@if($isSupplier)
    @section('breadcrumb-button')
        <a class="btn btn-primary" href="{{route('restaurant.index')}}"> <i class="fa fa-list"></i>  View</a>
    @endsection
    @section('content')
@else
    @section('breadcrumb-button')
        <a class="btn btn-primary" href="{{route('restaurants.index')}}"> <i class="fa fa-list"></i>  View</a>
    @endsection
    @section('main')
@endif

<div class="box mt-2">
    <div class="row">
        <div class="col-12">
            <div class="box-heading p-2">
                <x-service-management.restaurant-management.steps />
            </div>
            <div class="box-body">
                {{-- basic form inputs --}}
               @if (isset($restaurant) && $restaurant != null)
               {!! Form::model($restaurant, ['route' =>  ['restaurants.update', $restaurant->id], 'method' => 'put', 'onsubmit'=>'ajaxFormSubmit($(this))', 'autocomplete' => 'off', 'files' => true]) !!}
               @else
                {!! Form::open(['route' => 'restaurants.store', 'method' => 'post', 'onsubmit'=>'ajaxFormSubmit($(this))', 'autocomplete' => 'off', 'files' => true]) !!}
               @endif
               
                <div class="row mb-10">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label for="restaurant_type">RESTAURANT TYPE <span class="asterisk">*</span></label>
                            {!! Form::select('restaurant_type_id',getRestaurantType()->pluck('restaurant_type_name','id'), null,['id' => 'restaurant_type','class' => 'form-control','placeholder' => '--SELECT RESTAURANT TYPE--']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-10">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="restaurant_name">RESTAURANT NAME <span class="asterisk">*</span></label>
                            {!! Form::text('name', null, ['id' => 'restaurant_name','class' => 'form-control isAlpaNumeric','placeholder' => 'RESTAURANT NAME']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="restaurant_owner_name">OWNER NAME<span class="asterisk">*</span></label>
                            {!! Form::text('owner_name', null, ['id' => 'restaurant_owner_name','class' => 'form-control','placeholder' => 'RESTAURANT OWNER']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="restaurant_email">RESTAURANT EMAIL ADDRESS <small>(Optional)</small></label>
                            {!! Form::text('email', null, ['id' => 'restaurant_email','class' => 'form-control','placeholder' => 'EMAIL ADDRESS']) !!}
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="restaurant_contact">RESTAURANT CONTACT NUMBER <span class="asterisk">*</span></label>
                            {!! Form::text('contact', null, ['id' => 'restaurant_contact','class' => 'form-control isNumeric','placeholder' => 'CONTACT NUMBER']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                        </div>
                    </div>
                <div class="row mb-10">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="restaurant_address">RESTAURANT ADDRESS <span class="asterisk">*</span></label>
                            {!! Form::text('address', null, ['id' => 'restaurant_address','class' => 'form-control','placeholder' => 'RESTAURANT ADDRESS']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="supplier_name">SUPPLIER <span class="asterisk">*</span></label>
                            {!! Form::select('supplier_id', getSuppliers()->pluck('name','id'),null, ['class' => 'form-control select2','id'=> 'supplier_name', 'placeholder' => 'Select Supplier', 'onchange'=>'getCountriesOnChangeSupplier($(this).val())']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group" id="country_div" style="display:none">
                            <label for="restaurant_country">COUNTRY <span class="asterisk">*</span></label>
                            <div id="getCountryHtml">
                            </div>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group" id="city_div" style="display:none">
                            <label for="restaurant_city">CITY <span class="asterisk">*</span></label>
                            <div id="getCityHtml">
                            </div>
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="row mb-10">
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>RESTAURANT AVAILABILITY<span class="asterisk">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group date">
                                            {!! Form::text('valid_from_date', null, ['class' => 'form-control pull-right datepicker-future','placeholder' => 'FROM']) !!}
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group date">
                                            {!! Form::text('valid_to_date',NULL, ['class' => 'form-control pull-right datepicker-future' , 'placeholder' => 'TO']) !!}
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                        </div>
                                        <!-- /.input group -->
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="form-group">
                            <label>RESTAURANT TIMINGS<span class="asterisk">*</span></label>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="bootstrap-timepicker">
                                            <div class="input-group">
                                                {!! Form::text('valid_from_time', $restaurant? TwelveHourTime($restaurant->valid_from_time): null, ['class' => 'form-control timePicker']) !!}
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="bootstrap-timepicker">
                                            <div class="input-group">
                                                {!! Form::text('valid_to_time', $restaurant? TwelveHourTime($restaurant->valid_to_time): null, ['class' => 'form-control timePicker']) !!}
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock-o"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-10">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="no_of_tables">NO. OF TABLES <span class="asterisk">*</span></label>
                            {!! Form::text('no_of_tables', null, ['id' => 'no_of_tables', 'class' => 'form-control isNumeric']) !!}
                            <div class="invalid-feedback">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                            <label for="available_for_delivery_label">AVAILABLE FOR DELIVERY</label>
                            <br>
                            @if(isset($restaurant['available_for_delivery']) && $restaurant['available_for_delivery']==1)
                                {!! Form::checkbox('available_for_delivery', 1, true, ['id'=>'available_for_delivery_checkbox', 'class'=>'form-control checkbox-col-primary']) !!}
                            @else
                                {!! Form::checkbox('available_for_delivery', 1, null, ['id'=>'available_for_delivery_checkbox', 'class'=>'form-control checkbox-col-primary']) !!}
                            @endif
                            
                            <label for="available_for_delivery_checkbox">&nbsp;</label>
                        </div>
                    </div>
                </div>
                @php
                    if (isset($restaurant)) {
                        $weekdays = $restaurant->restaurant_available_days;
                    }
                    $operatingWeekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
                @endphp
                <div class="col-sm-12">
                    <h3 class="mb-3">Restaurant Available Days</h3>
                    @foreach ($operatingWeekdays as $key => $operationWeek)
                        @php
                            $checkOprationWeekYes = 'checked';
                            $checkOprationWeekNo = '';
                        @endphp
                        @isset($restaurant)
                            @php
                                if ($weekdays != null) {
                                    if (isset($weekdays[$operationWeek]) && $weekdays[$operationWeek] == 'yes') {
                                        $checkOprationWeekYes = 'checked';
                                    }
                                    if (isset($weekdays[$operationWeek]) && $weekdays[$operationWeek] == 'no') {
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
                                <input name="restaurant_available_days[{{ $operationWeek }}]" type="radio"
                                    id="week_{{ $operationWeek }}_1" class="with-gap radio-col-primary" value="yes"
                                    {{ $checkOprationWeekYes }}>
                                <label class="mr-4 mb-2" for="week_{{ $operationWeek }}_1">Yes </label>
                                <input name="restaurant_available_days[{{ $operationWeek }}]" type="radio"
                                    id="week_{{ $operationWeek }}_2" class="with-gap radio-col-primary" value="no"
                                    {{ $checkOprationWeekNo }}>
                                <label for="week_{{ $operationWeek }}_2">No</label>
                            </div>
                            <div class="invalid-feedback">
                            </div>
                            {{-- @error('operating_weekdays')
                                <p class="text-warning">{{ $message }}</p>
                            @enderror --}}
                        </div>
                    @endforeach
                </div>

                {{-- <div class="row mb-10" style="display: none">
                    <div class="col-sm-12 col-md-12 col-lg-6">
                        <div class="form-group">
                                    <label for="restaurant_currency">CURRENCY <span class="asterisk">*</span></label>
                                    <select class="form-control select2" style="width: 100%;" id="restaurant_currency" name="restaurant_currency">
                                        <option value="0" hidden>SELECT CURRENCY</option>
                                        @foreach($currency as $curr)
                                            <option value="{{$curr->code}}">{{$curr->code}} ({{$curr->name}})</option>
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-6">

                    </div>

                </div> --}}

                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="blackout_days">Blackout Days</label>
                        <div class="row">
                            <div class="col-sm-4"><button type="button" class="btn btn-success add-blackout-days" style="font-size: 1rem;"><i
                                        class="fa fa-plus" aria-hidden="true"></i> Blackout Days</button></div>
                            <div class="col-sm-8">
                                {!! Form::text('blackout_days', null, ['class' => 'form-control datepicker', 'id' => 'blackout_days','style' =>  isset($restaurant->blackout) ? "display:block;" : "display:none;",'placeholder' => 'Select Dates', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-10">
                            <div class="col-sm-12">
                                <div class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">

                                </div>
                                <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                                    <i class="fa fa-plus-circle"></i> RESTAURANT DESCRIPTION <span class="asterisk">*</span></h4>
                            </div>
                            <div class="col-sm-12">
                                <div class="box">
                                    <div class="box-body">
                                        {!! Form::textarea('description', null, ['class'=>'form-control', 'id'=>'description']) !!}
                                        <div class="invalid-feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                    <button class="btn btn-warning my-3 pull-right" type="submit">
                        <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next
                    </button>
               {!! Form::close() !!}
            </div>
        </div>
    </div> 
</div> 
@endsection





@push('scripts')
<script>
    @isset($restaurant)
    
            $(document).ready(function(){
                getCountriesOnChangeSupplier('{{$restaurant->supplier_id}}', '{{$restaurant->country_id}}')
                getCitiesOnChangeCountry('{{$restaurant->country_id}}', '{{$restaurant->city_id}}')
            })
        
    @endisset

//    basic form script

$(document).ready(function()
{
    
    CKEDITOR.replace('description');
    var date = new Date();
    date.setDate(date.getDate());

    $('.datepicker').datepicker({
        multidate: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        startDate:date
    }).on('changeDate', function (e) {
        var date_from = $("input[name='valid_from_date']").datepicker("getDate");
        var date_to = $("input[name='valid_to_date']").datepicker("getDate");

        if(!date_to)
        {
            $("input[name='valid_from_date']").datepicker("setDate",date_from);
        }
        else if(date_to<date_from)
        {
            $("input[name='valid_to_date']").datepicker("setDate",date_from);
        }
    });

    $(document).on('click', '.add-blackout-days', function() {
            $('#blackout_days').toggle();
        })

});

// end basic form scripts


</script>

@endpush


