@extends('layouts.guide')
@php
    $route = \Route::currentRouteName();
    if($route == 'guides.create'){
        $form = 'service-management.guides._form_basic';
        $action = 'guides.store';
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
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
    {!! Form::open(['id' => 'guides','route' => $action]) !!}
 
        @include($form)
        <button class="btn btn-warning my-3 pull-right">{!! $button !!}</button>
    {!! Form::close() !!}
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.add-blackout-days', function() {
            $('#blackout_days').toggle();
        })

        function getCountriesBySuppliers(id) {
            var options = '<option>--Select Country--</option>';
            $('#country').find('option:not(:first)').remove();
            $('#city_id').find('option:not(:first)').remove();
            $.ajax({
                type: 'get',
                url: '{{ url("get-supplier-country") }}',
                data: {
                    'id' : id
                },
                success: function (response) {
                    $.each(response, function (key, value) {
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
                url: '{{ url("getcities") }}',
                data: {
                    'country' : id
                },
                success: function (response) {
                    $.each(response, function (key, value) {
                        options += `<option value='${key}'>${value}</option>`;
                    });
                    $('#city_id').html(options);
                }
            })
        }
        $(document).on('submit','#activities',function(e){
            e.preventDefault()
            if(Validate()){
                ajaxFormSubmit($(this))
            }
        })

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
       if($('#inclusions').length > 0){
        CKEDITOR.replace('inclusions');
        CKEDITOR.replace('exclusions');
        CKEDITOR.replace('description');
        CKEDITOR.replace('cancel_policy');
        CKEDITOR.replace('terms_conditions');
        CKEDITOR.replace('confirm_message');
       }
        $('.timepicker').clockpicker()
        $(document).on('click', '.check-box', function() {
            if ($(this).hasClass('adult')) {
                $('.adult-column').toggle()
                if($(this).siblings('div').children('.col-sm-6').find('input').hasClass('validate'))
                    $(this).siblings('div').children('.col-sm-6').find('input').removeClass('validate')
                else
                $(this).siblings('div').children('.col-sm-6').find('input').addClass('validate')
            }
            if ($(this).hasClass('child')) {
                $('.child-column').toggle()
                if($(this).siblings('div').children('.col-sm-6').find('input').hasClass('validate'))
                    $(this).siblings('div').children('.col-sm-6').find('input').removeClass('validate')
                else
                $(this).siblings('div').children('.col-sm-6').find('input').addClass('validate')
            }
            if ($(this).hasClass('infant')) {
                $('.infant-column').toggle()
                if($(this).siblings('div').children('.col-sm-6').find('input').hasClass('validate'))
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
            var div = $(this).parent().parent().hasClass('adult-div') ? 'adult' : ($(this).parent().parent().hasClass('child-div') ? 'child' : 'infant');
            var count = $('.'+div+'-div').length;
            $(another).find('#min_pax').attr('name',div+'['+count+'][min_pax]')
            $(another).find('#max_pax').attr('name',div+'['+count+'][max_pax]')
            $(another).find('#price').attr('name',div+'['+count+'][price]')
            $(another).insertAfter($('.'+div+'-div:last-child'));
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
            $(another).children('div').find('#from_date').attr('name','session['+parent_count+'][from_date]').datepicker({
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                autoclose: true
            })
            $(another).children('div').find('#to_date').attr('name','session['+parent_count+'][to_date]').datepicker({
                todayHighlight: true,
                format: 'yyyy-mm-dd',
                autoclose: true
            })
            $(another).children('.col-sm-12').children('div').find('#time_from').attr('name','session['+parent_count+'][time_from][]')
            $(another).children('.col-sm-12').children('div').find('#time_to').attr('name','session['+parent_count+'][time_to][]')
            $(another).children('.col-sm-12').children('div').find('#no_of_pax').attr('name','session['+parent_count+'][no_of_pax][]')
            $(another).children('.col-sm-12').children('div').find('#surge').attr('name','session['+parent_count+'][surge][]')
            $(another).children('.col-sm-12').children('div').find('#discount').attr('name','session['+parent_count+'][discount][]')
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
@endpush
