@extends('agent::layouts.master')

@section('title')
Restaurant
@endsection

@push('style')
    <style>
        .search_btn{
            background-color: #234076 !important;
            border-color: #234076"
        }
    </style>
@endpush

@section('content')
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                {!! Form::open(['route' => 'agent.restaurant.filter', 'method' => 'post', 'class'=>'formss', 'onsubmit'=>'ajaxFormSubmit($(this))']) !!}
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                        <div class="form-group">
                            <label for="restaurant_type_id">Restaurant type <span class="asterisk">*</span></label>
                            {!! Form::select('restaurant_type_id', getRestaurantType()->pluck('restaurant_type_name','id'), null, ['class'=>'form-control select2', 'id'=>'restaurant_type_id', 'placeholder'=>'Select Restaurant Type']) !!}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                        <div class="form-group">
                            <label for="country_id">Country <span class="asterisk">*</span></label>
                            {!! Form::select('country_id', getCountries(true), null, ['class'=>'form-control select2 country_select','placeholder'=>'Select Country', 'onchange'=>'getCitiesOnChangeCountry($(this).val())']) !!}
                            <div class="invalid-feedback d-block">
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                        <div class="form-group">
                            <label for="city_id">City <span class="asterisk">*</span></label>
                            <div id="getCityHtml">
                                {!! Form::select('city_id', [], null, ['class'=>'form-control select2','placeholder'=>'Select City']) !!}
                            <div class="invalid-feedback d-block">
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                        <div class="form-group">
                            <label for="booking_date">Booking Date <span class="asterisk">*</span></label>
                            <div class="input-group date">                                   
                                {!! Form::text('booking_date', null, ['class'=>'form-control pull-right datepicker-future', 'id'=>'booking_date', 'placeholder'=>'Select Date', 'autocomplete'=>'off']) !!}
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="invalid-feedback d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                        <div class="form-group">
                            <label for="booking_time">Booking Time <span class="asterisk">*</span></label>
                            <div class="bootstrap-timepicker">
                                <div class="input-group">                                   
                                    {!! Form::text('booking_time', null, ['class'=>'form-control pull-right timePicker', 'id'=>'booking_time', 'placeholder'=>'Select Time', 'autocomplete'=>'off']) !!}
                                    <div class="input-group-addon">
                                        <i class="fa fa-clock-o"></i>
                                    </div>
                                    <div class="invalid-feedback d-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                        <div class="form-group">
                            <button type="submit" class="btn btn-success search_btn">Search</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>

        
        <div id="search_result">
            
        </div>

@push('scripts')
    <script>
        $(document).ready(function(){
            

        })
    </script>
@endpush
@endsection
