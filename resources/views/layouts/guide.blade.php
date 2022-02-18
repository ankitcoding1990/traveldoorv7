@php
  $layout = 'layouts.main';
    if(auth()->guard('supplier')->check()){
         $layout = 'suppliers::layouts.master';
    }
@endphp

@extends($layout)
@section('title', 'Edit Guide')
@php
    $route = \Route::currentRouteName();
@endphp
@section('main')
@if (auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <nav class="nav nav-pills nav-justified">
                <a class="nav-link @if ($route == 'guides.create' || $route == 'guides.edit' ) active @else disabled @endif" href="{{ url()->current() }}">Basic</a>
                <a class="nav-link @if ($route == 'activity.prices.create' || $route == 'activity.prices.edit') active @else disabled @endif" href="{{ url()->current()}}">Sightseeing Tours</a>
                <a class="nav-link @if ($route == 'activity.booking.create' || $route == 'activity.booking.edit') active @else disabled @endif" href="{{ url()->current()}}">Airport Transfers</a>
              
                <a class="nav-link @if ($route == 'activity.description.create' || $route == 'activity.description.edit') active @else disabled @endif" href="{{ url()->current()}}">Description</a>
            </nav>
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
