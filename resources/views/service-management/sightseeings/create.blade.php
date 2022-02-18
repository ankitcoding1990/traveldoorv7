@extends('layouts.sightseeings')
@php
    $route = \Route::currentRouteName();
    if($route == 'sightseeings.create'){
        $form = 'service-management.sightseeings.forms.basic';
        $action = 'sightseeings.store';
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Save & Next';
    }
    else if ($route == 'sightseeings.prices.create') {
        $form = 'service-management.sightseeings.forms.pricing';
        $action = ['sightseeings.prices.store',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Save & Next';
    }
    elseif($route == 'sightseeings.images.upload'){
        $form = 'service-management.sightseeings.forms.images';
        $action = ['sightseeings.images.store',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Save & Next';
    }
    else {
        $form = 'service-management.sightseeings.forms.description';
        $action = ['sightseeings.description.store',$id];
        $button = '<i class="fa fa-check" aria-hidden="true"></i> Submit';
    }
@endphp
@push('style')
    <style>
        .seprate {
            border-right: 1px solid rgb(182, 182, 182);
        }
        .navbar-gray {
            background: #ddd !important;
        }
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff !important;
            background-color: #2c4c87 !important;
        }
        .nav-link {
            border-right: 1px solid rgba(9, 9, 9, 0.212) !important;
        }
    </style>
@endpush
@section('content')
    {!! Form::open(['id' => 'sightseens','route' => $action,'files' => true,]) !!}
    @include($form)
    <button class="btn btn-warning my-3 pull-right" >{!! $button !!}</button>
    {!! Form::close() !!}
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
            if ($(this).val() > 1) {
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

