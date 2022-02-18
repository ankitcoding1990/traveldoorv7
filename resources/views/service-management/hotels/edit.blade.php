@extends('layouts.hotel')
@php
    $route = \Route::currentRouteName();
    if(!isset($id)){
        $id = $hotel->id;
    }
    if($route == 'hotels.edit'){
        $form = 'service-management.hotels.forms.basic';
        $action = ['hotels.update', $hotel->id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Update & Next';
    }
    else if ($route == 'hotels.amenities.edit') {
        $form = 'service-management.hotels.forms.amenities';
        $action = ['hotels.amenities.update',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Update & Next';
    }
    else if($route == 'hotels.images.edit'){
        $form = 'service-management.hotels.forms.images';
        $action = ['hotels.images.update',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Update & Next';
    }
      else if($route == 'hotels.description.edit'){
        $form = 'service-management.hotels.forms.description';
        $action = ['hotels.description.update',$id];
        $button = '<i class="fa fa-check" aria-hidden="true"></i> Update';
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
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <x-service-management.hotel-navbar :mode="'edit'" :id="$id ?? null" />
                <div class="box-body">
                    {!! Form::open(['id' => 'hotels', 'route' => $action, 'method' => 'put', 'files' => true]) !!}
                    @include($form)
                    <button class="btn btn-warning my-3 pull-right">{!! $button !!}</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection



@push('scripts')
    <script>
         $('.select2').select2();
         google.maps.event.addDomListener(window, 'load', initialize);
        function initialize() {
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
            });
        }
        $(document).on('submit', '#hotels', function(e) {
            e.preventDefault()
            if (Validate()) {
                ajaxFormSubmit($(this))
            }
        })

        $(document).on('click', '.add-blackout-days', function() {
            $('#blackout_days').toggle();
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

        // CKEDITOR.replace('tour_attractions');
       // CKEDITOR.replace('policy_description');
        CKEDITOR.replace('description');



    </script>

@endpush

