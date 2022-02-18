
@extends('layouts.main')
@php
$route = \Route::currentRouteName();
$routeForCreate = ['basic' => 'activities.create','pricing' => 'activity.prices.create','booking' => 'activity.booking.create','images' => 'activity-img-upload', 'description' => 'activity.description.create'];
$routeForEdit = ['basic' => 'activities.edit','pricing' => 'activity.prices.edit','booking' => 'activity.booking.edit','images' => 'activity-img-upload','description' => 'activity.description.create'];
@endphp
@section('main')
    @if (auth()->user()->hasAddPermission($routeName))
        <div class="row">
            <div class="col-12">
                <div class="box activity-tab">

                    <div class="box-body">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')

@endpush
