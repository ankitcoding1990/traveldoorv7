@extends('supplier::layouts.master')
@php
    $route = \Route::currentRouteName();
    if(!isset($id)){
        $id = $activity->id;
    }
if ($route == 'activity.edit') {
    $form = 'service-management.activities._form_basic';
    $action = ['activity.update', $activity->id];
    $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    $model = $activity;
} elseif ($route == 'supplier.activity.prices.edit') {
    $form = 'service-management.activities._form_pricing';
    $action = ['supplier.activity.prices.update', $id];
    $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    $model = $pricings;
} elseif ($route == 'supplier.activity.booking.edit') {
    $form = 'service-management.activities._form_booking';
    $action = ['supplier.activity.booking.update', $id];
    $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    $model = $bookings;
}elseif($route == 'supplier.activity.images.edit'){
        $form = 'service-management.activities._form_images';
        $action = ['supplier.activity.images.update',$id];
        $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Next';
    }
 else {
    $form = 'service-management.activities._form_description';
    $action = ['supplier.activity.description.update',$id];
    $button = '<i class="fa fa-check" aria-hidden="true"></i> Update';
    $model = $description;
}
@endphp
@section('title', 'Edit Activity')
@push('style')
    <style>
        .box-heading{
            background: #f2f3f8;
        }
        .nav-tabs > li{
            background: white !important;
        }
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
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-heading"><x-service-management.activity-navbar :mode="'edit'" :id="$id ?? null" :supplier="true" /></div>
            <div class="box-body">
                {!! Form::model($model ?? null,['id' => 'activities','route' => $action,'files' => true,]) !!}
                    @include($form)
                    <button type="submit" class="btn btn-warning my-3 pull-right">{!! $button !!}</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).on('submit', '#activities', function(e) {
        e.preventDefault()
        if (Validate()) {
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
    if ($('#inclusions').length > 0) {
        CKEDITOR.replace('inclusions');
        CKEDITOR.replace('exclusions');
        CKEDITOR.replace('description');
        CKEDITOR.replace('cancel_policy');
        CKEDITOR.replace('terms_conditions');
        CKEDITOR.replace('confirm_message');
    }
</script>
@endpush
