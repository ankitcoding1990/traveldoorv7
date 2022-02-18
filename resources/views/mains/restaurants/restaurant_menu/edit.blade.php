@extends('layouts.main')
@section('main')
@if(auth()->user()->hasEditPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Restaurant Menu Category</h4>
            </div>
            <div class="box-body">
                    {!! Form::model($restaurant_menu,['class' => 'package_form', 'method' => 'put','route' => ['restaurant-categories.update',$restaurant_menu->id]]) !!}
                    @include('mains.restaurants.restaurant_menu._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit"  id="save_restaurant_menu_category" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@else
<h4 class="text-danger">No rights to access this page</h4>
@endif
@push('styles')
<style>
    .iti-flag {
    width: 20px;
    height: 15px;
    box-shadow: 0px 0px 1px 0px #888;
    background-image: url("{{asset('assets/images/flags.png')}}") !important;
    background-repeat: no-repeat;
    background-color: #DBDBDB;
    background-position: 20px 0
    }
    div#cke_1_contents {
    height: 250px !important;
    }
    </style>
@endpush
@endsection
