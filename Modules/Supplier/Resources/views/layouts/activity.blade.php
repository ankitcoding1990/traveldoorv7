
@push('style')
    <style>
        .activity-tab ul.nav.nav-tabs li:first-child a {
            border-top-left-radius: 8px !important;
        }

        .activity-tab ul.nav.nav-tabs li:last-child a {
            border-top-right-radius: 8px !important;
        }

        .activity-tab a.nav-link {
            border-radius: 0px !important;
            font-size: 16px;
        }

        .activity-tab a.active {
            background: #234076 !important;
            border: 1px solid #234076 !important;
            font-weight: 600;
        }

        .add-blackout-days {
            background: #ec407a !important;
            border: 0;
        }

        .activity-tab .btn-success.add-blackout-days:hover {
            background: #e2175b !important;
        }

        .activity-tab ul.nav.nav-tabs {
            border: 0;
        }

        @media screen and (max-width:600px) {
            .activity-tab a.nav-link {
                font-size: 14px;
            }
        }

    </style>
@endpush

@extends('supplier::layouts.master')
@php
$route = \Route::currentRouteName();
@endphp
@section('content')
        <div class="row">
            <div class="col-12">
                <div class="box activity-tab">
                    <ul class="nav nav-tabs">
                        <li>
                            <a class="nav-link @if ($route == 'activity.create' || $route == 'activity.edit') active @endif"
                                href="{{ url()->current() }}">Basic</a>
                        </li>
                        <li>
                            <a class="nav-link @if ($route == 'supplier.activity.prices.create' || $route == 'supplier.activity.prices.edit') active @endif" href="{{ url()->current() }}">Pricing</a>
                        </li>
                        <li>
                            <a class="nav-link @if ($route == 'supplier.activity.booking.create' || $route == 'supplier.activity.booking.edit') active @endif" href="{{ url()->current() }}">Booking</a>
                        </li>
                        <li>
                            <a class="nav-link @if ($route == 'supplier.activity.images.create' || $route == 'supplier.activity.images.edit') active @endif" href="{{ url()->current() }}">Images</a>
                        </li>
                        <li>
                            <a class="nav-link @if ($route == 'supplier.activity.description.create' || $route == 'supplier.activity.description.edit') active @endif" href="{{ url()->current() }}">Description</a>
                        </li>
                    </ul>
                    <div class="box-body">
                        @yield('main')
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('scripts')

@endpush
