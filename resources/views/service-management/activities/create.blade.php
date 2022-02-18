@extends('layouts.main')
@push('style')
<style>
    .error-from{
        color: red;
    }
    .error-to{
        color: red;
    }
</style>
@endpush
@section('title', 'Create New Activity')
@php
    $route = \Route::currentRouteName();
    if($route == 'activities.create'){
        $form = 'service-management.activities._form_basic';
        $action = 'activities.store';
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    }
    else if ($route == 'activity.prices.create') {
        $form = 'service-management.activities._form_pricing';
        $action = ['activity.prices.store',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    }
    elseif ($route == 'activity.booking.create') {
        $form = 'service-management.activities._form_booking';
        $action = ['activity.booking.store',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    }
    elseif($route == 'activity-img-upload'){
        $form = 'service-management.activities._form_images';
        $action = ['activity-img',['id' => $id]];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    }
    else {
        $form = 'service-management.activities._form_description';
        $action = 'description.store';
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
@section('main')
<div class="row">
    <div class="col-12">
        <div class="box">
            <x-service-management.activity-navbar :mode="'create'" :id="$id ?? null" />
            <div class="box-body">
                {!! Form::open(['id' => 'activities','route' => $action,'files' => true,]) !!}
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
        // $('.timepicker').clockpicker()




    </script>
@endpush
