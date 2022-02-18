<div class="row p-3">
    <h3 class="m-2">SightSeeing Basic</h3>
    @auth()
        <input type="hidden" name="created_admin_id" value="{{ auth()->check() ? auth()->id() : null }}">
    @else
        <input type="hidden" name="created_supplier_id"
            value="{{ auth()->guard('supplier')->check()? auth()->guard('supplier')->user()->id: null }}">
    @endauth

    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Tour Name</label>
            {!! Form::text('tour_name', $sightseeing->tour_name ?? null, ['class' => 'form-control validate', 'placeholder' => 'Tour name']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="supplier">Tour Type</label>
            {!! Form::select('tour_type', getTourType()->pluck('tour_type_name', 'id'), $sightseeing->tour_type ?? null, ['class' => 'form-select select2 validate', 'id' => 'tour_type', 'placeholder' => '--Select Tour Type--']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="country">Country </label>
            {!! Form::select('country_id', getCountries(), $sightseeing->country_id ?? null, ['class' => 'form-select validate select2', 'id' => 'country', 'placeholder' => '--Select Country--', 'onchange' => 'getCitiesByCountry($(this).val())']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="city_id">From City</label>
            @if ($sightseeing)
                {!! Form::select('from_city_id', $sightseeing->getCountry->cities->pluck('name', 'id') ?? [], $sightseeing->from_city_id, ['class' => 'form-select validate select2', 'id' => 'from_city_id', 'placeholder' => '--Select City--']) !!}
            @else
                {!! Form::select('from_city_id', [], null, ['class' => 'form-select validate select2', 'id' => 'from_city_id', 'placeholder' => '--Select City--']) !!}
            @endif
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="city_id">To City</label>
            @if ($sightseeing)
                {!! Form::select('to_city_id', $sightseeing->getCountry->cities->pluck('name', 'id') ?? [], $sightseeing->to_city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'to_city_id', 'placeholder' => '--Select City--']) !!}
            @else
                {!! Form::select('to_city_id', [], $sightseeing->to_city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'to_city_id', 'placeholder' => '--Select City--']) !!}
            @endif
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="supplier">No. of Cities Covered</label>
            {!! Form::text('city_covered', $sightseeing->city_covered ?? null, ['class' => 'form-control isNumeric validate', 'id' => 'cities_covered', 'placeholder' => 'No. of City Covered Eg: 5', 'max' => '10']) !!}
        </div>
    </div>
    <div class="col-sm-6" id="in_between_cities" style="{{ $sightseeing ? '' : 'display:none' }}">
        <div class="form-group">
            <label for="type">In Between Cities</label>
            @if ($sightseeing)
                {!! Form::select('city_between_ids[]', $sightseeing->getCountry->cities->pluck('name', 'id') ?? [], $sightseeing->city_between_ids ?? null, ['class' => 'form-select select2 form-control ', 'id' => 'cities_between', 'placeholder' => 'Add Cities', 'multiple']) !!}
            @else
                {!! Form::select('city_between_ids[]', [], $sightseeing->city_between_ids ?? null, ['class' => 'form-select select2 form-control ', 'id' => 'cities_between', 'placeholder' => 'Add Cities', 'multiple']) !!}
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Distance Covered <span>(in KMS)</span> </label>
            {!! Form::text('distance_covered', $sightseeing->distance_covered ?? null, ['class' => 'form-control isNumeric validate', 'placeholder' => 'Distance Covered']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Duration <span>(in Hours)</span> </label>
            {!! Form::text('duration', $sightseeing->duration ?? null, ['class' => 'form-control isNumeric validate', 'placeholder' => 'Duration (in hours)']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="supplier">Fuel Type</label>
            {!! Form::select('fuel_type_id', getFuelType()->pluck('fuel_type', 'id'), $sightseeing->fuel_type_id ?? null, ['class' => 'form-control Select2', 'id' => 'fuel_type', 'placeholder' => '--Select Fuel--', 'tabindex' => '-1', 'mutiple']) !!}
            <small class="invalid-feedback"></small>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Food Cost </label>
            {!! Form::text('food_cost', $sightseeing->food_cost ?? null, ['class' => 'form-control isNumeric validate', 'id' => 'food_cost', 'placeholder' => 'Food Cost']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">Hotel Cost</label>
            {!! Form::text('hotel_cost', $sightseeing->hotel_cost ?? null, ['class' => 'form-control isNumeric validate', 'id' => 'hotel_cost', 'placeholder' => 'Hotel Cost']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">TOUR EXPENSE WITHOUT ENTRANCE </label>
            @if ($sightseeing)
                {!! Form::text('tour_expense_without_entrance', $sightseeing->food_cost + $sightseeing->hotel_cost, ['class' => 'form-control validate', 'placeholder' => 'Tour Expense without entrance', 'disabled', 'id' => 'tour_expense_without_entrance']) !!}
            @else
                {!! Form::text('tour_expense_without_entrance', null, ['class' => 'form-control validate', 'placeholder' => 'Tour Expense without entrance', 'disabled', 'id' => 'tour_expense_without_entrance']) !!}
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">ENTRANCE FEES FOR 1 ADULT </label>
            {!! Form::text('adult_cost', $sightseeing->adult_cost ?? null, ['class' => 'form-control validate', 'placeholder' => 'Enterance fees for 1 adult']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">ENTRANCE FEES FOR 1 CHILD <span>(2 - 10 YEARS)</span> </label>
            {!! Form::text('child_cost', $sightseeing->child_cost ?? null, ['class' => 'form-control validate', 'placeholder' => 'Entrance fees for 1 child']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">DEFAULT GUIDE PRICE</label>
            {!! Form::text('default_guide_price', $sightseeing->default_guide_price ?? null, ['class' => 'form-control validate', 'placeholder' => 'Default guide price']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">DEFAULT DRIVER PRICE</label>
            {!! Form::text('default_driver_price', $sightseeing->default_driver_price ?? null, ['class' => 'form-control validate', 'placeholder' => 'default driver price']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">ADDITIONAL COST </label>
            {!! Form::text('additional_cost', $sightseeing->additional_cost ?? null, ['class' => 'form-control validate', 'placeholder' => 'Additional cost']) !!}
        </div>
    </div>
    <div class="row jumbotron p-4">
        <h3>Discount</h3>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="type">From Date</label>
                {!! Form::text('from_date', $sightseeing->from_date ?? null, ['class' => 'form-control validate datepicker', 'placeholder' => 'valid from date']) !!}
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="type">To Date</label>
                {!! Form::text('to_date', $sightseeing->to_date ?? null, ['class' => 'form-control validate datepicker', 'placeholder' => 'valid till date']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">No. Of Pax</label>
                {!! Form::text('no_of_pax', $sightseeing->no_of_pax ?? null, ['class' => 'form-control isNumeric validate', 'placeholder' => 'No. of person']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Surge</label>
                {!! Form::text('surge', $sightseeing->surge ?? null, ['class' => 'form-control isNumeric validate validDisabled', 'id' => 'addSurge', 'placeholder' => 'Increment %']) !!}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="type">Discount</label>
                {!! Form::text('discount', $sightseeing->discount ?? null, ['class' => 'form-control isNumeric validate validDisabled', 'id' => 'addDiscount', 'placeholder' => 'Decrement %']) !!}
            </div>
        </div>


    </div>

</div>
