

@extends($layout)
@section('title', 'Edit Sighseeings')
@php
$route = \Route::currentRouteName();
@endphp
@section('main')
    @if (auth()->user()->hasAddPermission($routeName))
        <div class="row">
            <div class="col-12">
                <div class="box">
                    @if($sightseeing)
                    {!! Form::open(['id' => 'sightseens', 'method'=>'put', 'route' => ['sightseeings.update', $sightseeing->id]]) !!}
                  
                    @else
                    {!! Form::open(['id' => 'sightseens', 'route' => 'sightseeings.store']) !!}
                    @endif
                    <div class="box-body">
                        <div class="row p-3">
                            <h3 class="m-2">SightSeeing Basic</h3>
                            <input type="hidden" name="created_by" value="{{ auth()->check() ? auth()->id() : null }}">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">Tour Name</label>
                                    {!! Form::text('tour_name', $sightseeing->tour_name ?? null, ['class' => 'form-control validate', 'placeholder' => 'Guide first name']) !!}
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
                                        {!! Form::select('from_city_id', $sightseeing->country->cities->pluck('name', 'id') ?? [], $sightseeing->from_city_id, ['class' => 'form-select validate select2', 'id' => 'from_city_id', 'placeholder' => '--Select City--']) !!}
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
                                        {!! Form::select('to_city_id', $sightseeing->country->cities->pluck('name', 'id') ?? [], $sightseeing->to_city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'to_city_id', 'placeholder' => '--Select City--']) !!}
                                    @else
                                        {!! Form::select('to_city_id', [], $sightseeing->to_city_id ?? null, ['class' => 'form-select validate select2', 'id' => 'to_city_id', 'placeholder' => '--Select City--']) !!}
                                    @endif
                                    <small class="invalid-feedback"></small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="supplier">No. of Cities Covered</label>
                                    {!! Form::text('city_covered', $sightseeing->city_covered ?? null, ['class' => 'form-control isNumeric', 'id' => 'cities_covered', 'placeholder' => 'No. of City Covered Eg: 5', 'max' => '10']) !!}

                                    <small class="invalid-feedback"></small>
                                </div>
                            </div>
                            <div class="col-sm-6" id="in_between_cities"
                                style="{{ $sightseeing ? '' : 'display:none' }}">
                                <div class="form-group">
                                    <label for="type">In Between Cities</label>
                                    @if ($sightseeing)
                                        {!! Form::select('city_between_ids[]', $sightseeing->country->cities->pluck('name', 'id') ?? [], $sightseeing->city_between_ids ?? null, ['class' => 'form-select select2 form-control validate', 'id' => 'cities_between', 'placeholder' => 'Add Cities', 'multiple']) !!}
                                    @else
                                        {!! Form::select('city_between_ids[]', [], $sightseeing->city_between_ids ?? null, ['class' => 'form-select select2 form-control validate', 'id' => 'cities_between', 'placeholder' => 'Add Cities', 'multiple']) !!}
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">Distance Covered <small>(in KMS)</small> </label>
                                    {!! Form::text('distance_covered', $sightseeing->distance_covered ?? null, ['class' => 'form-control validate', 'placeholder' => 'Distance Covered']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">Duration <small>(in Hours)</small> </label>
                                    {!! Form::text('duration', $sightseeing->duration ?? null, ['class' => 'form-control validate', 'placeholder' => 'Duration (in hours)']) !!}
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
                                    {!! Form::text('food_cost', $sightseeing->food_cost ?? null, ['class' => 'form-control validate', 'id' => 'food_cost', 'placeholder' => 'Food Cost']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">Hotel Cost</label>
                                    {!! Form::text('hotel_cost', $sightseeing->hotel_cost ?? null, ['class' => 'form-control validate', 'id' => 'hotel_cost', 'placeholder' => 'Hotel Cost']) !!}
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
                                    {!! Form::text('adult_cost', $sightseeing->adult_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">ENTRANCE FEES FOR 1 CHILD <small>(2 - 10 YEARS)</small> </label>
                                    {!! Form::text('child_cost', $sightseeing->child_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">DEFAULT GUIDE PRICE</label>
                                    {!! Form::text('default_guide_price', $sightseeing->default_guide_price ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">DEFAULT DRIVER PRICE</label>
                                    {!! Form::text('default_driver_price', $sightseeing->default_driver_price ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">ADDITIONAL COST </label>
                                    {!! Form::text('additional_cost', $sightseeing->additional_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="type">Discount <small>(0 - 5)</small></label>
                                    {!! Form::text('discount', $sightseeing->discount ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                </div>
                            </div>

                        </div>

                        <div class="accordion" id="GroupTourPrice">
                            <div class="card">
                                <div class="card-header bg-light p-2" id="headingOne">
                                    <h2 class="m-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#GroupTour" aria-expanded="true"
                                            aria-controls="GroupTour">
                                            GROUP TOUR PRICE
                                        </button>
                                    </h2>
                                </div>
                                <div id="GroupTour" class="collapse {{ $sightseeing ? 'show' : '' }}"
                                    aria-labelledby="headingOne" data-parent="#GroupTourPrice">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="type">PRICE FOR 1 ADULT </label>
                                                    {!! Form::text('group_adult_cost', $sightseeing->group_adult_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="type">PRICE FOR 1 CHILD <small>(2 - 10 YEARS)</small>
                                                    </label>
                                                    {!! Form::text('group_child_cost', $sightseeing->group_child_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="type">NO OF PAX PER GROUP</label>
                                                    {!! Form::text('group_max_pax', $sightseeing->group_max_pax ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="type">GROUP TOUR TERMS & CONDITIONS</label>
                                                    {!! Form::textarea('group_tour_terms', $sightseeing->group_tour_terms ?? null, ['class' => 'form-control', 'id' => 'group_tour_terms', 'placeholder' => 'Term and conditions']) !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="accordion" id="TourDescAccrodion">
                            <div class="card">
                                <div class="card-header bg-light p-2" id="headingOne">
                                    <h2 class="m-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#TourDescription" aria-expanded="true"
                                            aria-controls="TourDescription">
                                            TOUR DESCRIPTION
                                        </button>
                                    </h2>
                                </div>
                                <div id="TourDescription" class="collapse {{ $sightseeing ? 'show' : '' }}"
                                    aria-labelledby="headingOne" data-parent="#TourDescAccrodion">
                                    <div class="card-body">
                                        <div class="form-group">
                                            {!! Form::textarea('tour_desc', $sightseeing->tour_desc ?? null, ['class' => 'form-control', 'id' => 'sightseeing_desc', 'placeholder' => 'Term and conditions']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion" id="TourAccrodion">
                            <div class="card">
                                <div class="card-header bg-light p-2" id="headingOne">
                                    <h2 class="m-0">
                                        <button class="btn btn-link btn-block text-left" type="button"
                                            data-toggle="collapse" data-target="#TourAttraction" aria-expanded="true"
                                            aria-controls="TourAttraction">
                                            TOUR ATTRACTIONS
                                        </button>
                                    </h2>
                                </div>
                                <div id="TourAttraction" class="collapse {{ $sightseeing ? 'show' : '' }}"
                                    aria-labelledby="headingOne" data-parent="#TourAccrodion">
                                    <div class="card-body">
                                        <div class="form-group">
                                            {!! Form::textarea('attractions', $sightseeing->attractions ?? null, ['class' => 'form-control', 'id' => 'tour_attractions', 'placeholder' => 'Term and conditions']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-warning my-3 pull-right"><i class="fa fa-save" aria-hidden="true"></i> Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endif
@endsection


@push('scripts')
    <script>
        // select2-selection
        $(document).on('submit', '#sightseens', function(e) {
            e.preventDefault()
            if (Validate()) {
                ajaxFormSubmit($(this))
            }
        })
        $(document).on("change", "#food_cost,#hotel_cost", function() {
            var food_cost = $("#food_cost").val();
            var hotel_cost = $("#hotel_cost").val();
            if (food_cost == "") {
                food_cost = 0;
            }
            if (hotel_cost == "") {
                hotel_cost = 0;
            }
            var totalcost = parseFloat(parseFloat(food_cost) + parseFloat(hotel_cost));
            $("#tour_expense_without_entrance").val((Math.round((totalcost * 1000) / 10) / 100).toFixed(2));
        });
        $(document).on('change', '#cities_covered', function() {
            if ($(this).val() > 2) {
                $('#in_between_cities').show();
                $('#cities_between').select2();
            } else {
                $('#in_between_cities').hide();
                $('#cities_between').val('');
            }
        })

        function getCountriesBySuppliers(id) {
            var options = '<option>--Select Country--</option>';
            $('#country').find('option:not(:first)').remove();
            $('#city_id').find('option:not(:first)').remove();
            $.ajax({
                type: 'get',
                url: '{{ url('get-supplier-country') }}',
                data: {
                    'id': id
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        options += `<option value='${key}'>${value}</option>`;
                    });
                    $('#country').html(options);
                }
            })
        }

        function getCitiesByCountry(id) {
            var options = '<option>--Select City--</option>';
            $.ajax({
                type: 'get',
                url: '{{ url('getcities') }}',
                data: {
                    'country': id
                },
                success: function(response) {
                    $.each(response, function(key, value) {
                        options += `<option value='${key}'>${value}</option>`;
                    });
                    $('#to_city_id').html(options);
                    $('#from_city_id').html(options);
                    $('#cities_between').html(options);
                }
            })
        }

        $('#blackout_days').datepicker({
            multidate: true,
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            startDate: new Date(),
        })
        $('.datepicker').datepicker({
            todayHighlight: true,
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        CKEDITOR.replace('tour_attractions');
        CKEDITOR.replace('sightseeing_desc');
        CKEDITOR.replace('group_tour_terms');
        $('.select2').select2();
        $('.timepicker').clockpicker()
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
        $(document).on('click', '.addprice', function() {
            var another = $(this).parent().parent().clone();
            $(another).find('.addprice').removeClass('addprice').addClass('removeprice').html(
                '<i class="fa fa-minus" aria-hidden="true"></i> Remove')
            $(another).find('input').val('');
            var div = $(this).parent().parent().hasClass('adult-div') ? 'adult' : ($(this).parent().parent()
                .hasClass('child-div') ? 'child' : 'infant');
            var count = $('.' + div + '-div').length;
            $(another).find('#min_pax').attr('name', div + '[' + count + '][min_pax]')
            $(another).find('#max_pax').attr('name', div + '[' + count + '][max_pax]')
            $(another).find('#price').attr('name', div + '[' + count + '][price]')
            $(another).insertAfter($('.' + div + '-div:last-child'));
        })
        $(document).on('click', '.removeprice, .remove-time, .remove-session', function() {
            $(this).parent().parent().remove()
        })
        $(document).on('click', '.add-session', function() {
            var another = $(this).parent().parent().clone();
            $(another).find('h3').remove();
            $(another).children('.col-sm-12').children('.row').find('.remove-time').parent().parent().remove()
            $(another).children('.col-sm-4').find('.add-session').removeClass('add-session').addClass(
                'remove-session').html('<i class="fa fa-minus" aria-hidden="true"></i> Session')
            $(another).children('div').find('input').val('')
            var parent_count = $('.parent-div').length
            $(another).children('div').find('#from_date').attr('name', 'session[' + parent_count + '][from_date]')
                .datepicker({
                    todayHighlight: true,
                    format: 'yyyy-mm-dd',
                    autoclose: true
                })
            $(another).children('div').find('#to_date').attr('name', 'session[' + parent_count + '][to_date]')
                .datepicker({
                    todayHighlight: true,
                    format: 'yyyy-mm-dd',
                    autoclose: true
                })
            $(another).children('.col-sm-12').children('div').find('#time_from').attr('name', 'session[' +
                parent_count + '][time_from][]')
            $(another).children('.col-sm-12').children('div').find('#time_to').attr('name', 'session[' +
                parent_count + '][time_to][]')
            $(another).children('.col-sm-12').children('div').find('#no_of_pax').attr('name', 'session[' +
                parent_count + '][no_of_pax][]')
            $(another).children('.col-sm-12').children('div').find('#surge').attr('name', 'session[' +
                parent_count + '][surge][]')
            $(another).children('.col-sm-12').children('div').find('#discount').attr('name', 'session[' +
                parent_count + '][discount][]')
            $(another).insertAfter($('.parent-div:last-child'))
        })
        $(document).on('click', '.add-time', function() {
            var another = $(this).parent().parent().clone();
            $(another).children('.col-sm-12').find('.add-time').removeClass('add-time').addClass('remove-time')
                .html('<i class="fa fa-minus" aria-hidden="true"></i> Duration')
            $(another).children('div').find('input').val('');
            $(another).insertAfter($('.child-div:last-child'));
        })
    </script>
    <script>
        function previewFile(idOfFileTag, IdOfPreviewTag, IdOfLabelTag) {
            var preview = document.querySelector('#' + IdOfPreviewTag);
            var file = document.querySelector('#' + idOfFileTag).files[0];
            var label = document.querySelector('#' + IdOfLabelTag);
            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = "block";
                label.style.display = 'none';
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                label.style.display = 'block';
                preview.style.display = "none";
            }
        }
    </script>
@endpush
