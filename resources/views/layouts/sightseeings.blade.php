@php
  $layout = 'layouts.main';
    if(auth()->guard('supplier')->check()){
         $layout = 'supplier::layouts.master';
    }
@endphp

@extends($layout)
@section('title', 'Edit Sightseeing')
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
                    <a class="nav-link @if ($route == 'sightseeings.create' || $route == 'sightseeings.edit') active @endif"
                        href="{{ url()->current() }}">Basic</a>
                </li>
                <li>
                    <a class="nav-link @if ($route == 'sightseeings.prices.create' || $route == 'sightseeings.prices.edit') active @endif" href="{{ url()->current() }}">Group Tour Price</a>
                </li>
                <li>
                    <a class="nav-link  @if ($route == 'sightseeings.images.upload') active @endif" href="{{ url()->current() }}">Images</a>
                </li>
                <li>
                    <a class="nav-link @if ($route == 'sightseeings.description.create') active @endif
                        href="{{ url()->current() }}">Description</a>
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

@endpush
