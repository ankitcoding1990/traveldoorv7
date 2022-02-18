
@extends('layouts.main')
@section('title', 'Hotel')
@php
$route = \Route::currentRouteName();
$routeForCreate = ['basic' => 'hotels.create','amenities' => 'hotels.amenities.create','images' => 'hotels.images.upload', 'description' => 'hotels.description.create'];
$routeForEdit = ['basic' => 'hotels.edit','amenities' => 'hotels.amenities.edit','images' => 'hotels.images.upload','description' => 'hotels.description.create'];
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

{{--
@php
  $layout = 'layouts.main';
    if(auth()->guard('supplier')->check()){
         $layout = 'supplier::layouts.master';
    }
@endphp

@extends($layout)
@section('title', 'Hotel')
@php
    $route = \Route::currentRouteName();
@endphp
@section('main')
@if (auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <ul class="nav nav-tabs">
                <li>
                    <a class="nav-link @if ($route == 'hotels.create' || $route == 'hotels.edit') active @endif"
                        href="{{ url()->current() }}">Basic</a>
                </li>
                <li>
                    <a class="nav-link  @if ($route == 'hotels.amenities.create' || $route == 'hotels.amenities.edit') active @endif"" href="{{ url()->current() }}">Amenities</a>
                </li>
                  <li>
                    <a class="nav-link  @if ($route == 'hotels.images.upload') active @endif"" href="{{ url()->current() }}">Images</a>
                </li>
                <li>
                    <a class="nav-link  @if ($route == 'hotels.description.create' || $route == 'hotels.description.edit') active @endif"" href="{{ url()->current() }}">Description</a>
                </li>

            </ul>
            <div class="box-body">
                @yield('content')
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@push('scripts')

@endpush --}}
