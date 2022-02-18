
@push('style')
    <style>
        [type="radio"]:not(:checked)+label,
        [type="radio"]:checked+label {

            padding-left: 40px;
        }

        [type="radio"]+label:before,
        [type="radio"]+label:after {
            margin: 0px !important;
            transition: unset !important;
        }

        [type="radio"]:not(:checked)+label:before,
        [type="radio"]:not(:checked)+label:after {
            border: unset !important;
            transform: unset;
        }

        [type=radio]:checked+label:after {
            border: unset !important;
            background-color: unset !important;
            transform: unset;
        }

        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
        }

        .rate:not(:checked)>input {
            position: absolute;
        }

        .rate:not(:checked)>label {
            float: right;
            width: 1em;
            overflow: hidden;
            white-space: nowrap;
            cursor: pointer;
            font-size: 3rem;
            color: #ccc;
        }

        .rate:not(:checked)>label:before {
            content: '★ ';
        }

        .rate>input:checked~label {
            color: #ffc700;
        }

        .rate:not(:checked)>label:hover,
        .rate:not(:checked)>label:hover~label {
            color: #deb217;
        }

        .rate>input:checked+label:hover,
        .rate>input:checked+label:hover~label,
        .rate>input:checked~label:hover,
        .rate>input:checked~label:hover~label,
        .rate>label:hover~input:checked~label {
            color: #c59b08;
        }

    </style>
@endpush
<div class="row p-3">
    <h3 class="m-2">Hotel Basic</h3>
    @auth()
        <input type="hidden" name="created_admin_id" value="{{ auth()->check() ? auth()->id() : null }}">
    @else
        <input type="hidden" name="supplier_id"
            value="{{ auth()->guard('supplier')->check()? auth()->guard('supplier')->user()->id: null }}">
    @endauth

    <div class="col-sm-6">
        <div class="form-group">
            <label for="country">Hotel Type </label>
            {!! Form::select('hotel_type_id', getHotelType()->pluck('hotel_type_name', 'id'), $hotel->hotel_type_id ?? null, ['class' => 'form-select validate select2', 'id' => 'hotel_type', 'tabindex' => '-1', 'placeholder' => '--Select hotel--']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Own Supplier</label>
            {!! Form::select('supplier_id', getSuppliers()->pluck('name', 'id'), $hotel->supplier_id ?? null, ['class' => 'form-select validate select2', 'id' => 'supplierId', 'placeholder' => '--Select Supplier--', 'tabindex' => '-1', 'onchange' => 'getCountriesOnChangeSupplier($(this).val())']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Country</label>
            @if($hotel)
            {!! Form::select('country_id', getCountries(), $hotel->country_id ?? null, ['class' => 'form-select validate select2', 'id' => 'getCountryHtml', 'placeholder' => '--Select Supplier First--', 'tabindex' => '-1', 'onchange' => 'getCitiesOnChangeCountry($(this).val())']) !!}
            @else
               {!! Form::select('country_id', [], $hotel->country_id ?? null, ['class' => 'form-select validate select2', 'id' => 'getCountryHtml', 'placeholder' => '--Select Supplier First--', 'tabindex' => '-1', 'onchange' => 'getCitiesOnChangeCountry($(this).val())']) !!}
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">City</label>
            @if($hotel)
            {!! Form::select('city_id', $hotel->getCountry->cities->pluck('name', 'id') ?? [], $hotel->city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'getCityHtml', 'placeholder' => '--Select Country First--']) !!}
            @else
             {!! Form::select('city_id', [], $hotel->city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'getCityHtml', 'placeholder' => '--Select Country First--']) !!}
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Hotel Name</label>
            {!! Form::text('hotel_name', $hotel->hotel_name ?? null, ['class' => 'form-control validate', 'placeholder' => 'Hotel name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Contact Number</label>
            {!! Form::text('hotel_contact', $hotel->hotel_contact ?? null, ['class' => 'form-control validate isNumeric', 'placeholder' => 'Hotel Contact', 'maxlength' => '12']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Currency</label>
            {!! Form::select('currency_id', activeCurrencies()->pluck('full_name', 'id'), $hotel->currency_id ?? null, ['class' => 'form-select validate select2', 'placeholder' => '--Select Currency--']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="location">Location</label>
            {!! Form::text('location', $hotel->location ?? null, ['class' => 'form-control validate isAlpaNumeric', 'id' => 'location', 'placeholder' => 'Location']) !!}
        </div>
    </div>

    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Booking validity</label>
            <div class="row">
                <div class="col-md-6">
                    {!! Form::text('booking_validity_from', $hotel->booking_validity_from ?? null, ['class' => 'form-control validate datepicker-future', 'placeholder' => 'From']) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::text('booking_validity_to', $hotel->booking_validity_to ?? null, ['class' => 'form-control validate datepicker-future', 'placeholder' => 'To']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="blackout_dates">Blackout Days</label>
            <div class="row">
                <div class="col-sm-4"><button type="button" class="btn btn-success add-blackout-days"
                        style="font-size: 1rem;"><i class="fa fa-plus" aria-hidden="true"></i> Blackout
                        Days</button></div>
                <div class="col-sm-8">
                    {!! Form::text('blackout_dates', $hotel->blackout_dates ?? null, ['class' => 'form-control', 'id' => 'blackout_days', 'style' => isset($hotel->blackout_dates) ? 'display:block;' : 'display:none;', 'placeholder' => 'Select Dates', 'autocomplete' => 'off']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12">
        <label> Hotel Description </label>
        {!! Form::textarea('description', $hotel->description ?? null, ['class' => 'form-control','id' => 'description']) !!}
    </div>
    <div class="col-sm-4 mt-4">
        <div class="form-group">
            <label for="type">Hotel Rating</label>
            <div class="rate">
                @for($i = 5; $i>=1; $i--)
                 <input name="hotel_rating" type="radio" id="star{{$i}}" name="rate" value="{{$i}}" {{!empty($hotel->hotel_rating) && $hotel->hotel_rating == $i ? 'checked': ''}} />
                <label for="star{{$i}}" title="{{$i}} star">5</label>
                @endfor
            </div>
        </div>
    </div>



</div>
