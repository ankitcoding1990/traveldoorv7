@extends('layouts.main')

@section('title', 'Supplier Profile')
@section('subtitle', 'Profile')
@php
    $country       = $supplier->supplierCountry;
    $city          = $supplier->supplierCity;
    $oprCountries  = $supplier->operateCountries();
    $oprCurrency   = $supplier->operateCurrency();
    $currentRoute  = Route::currentRouteName();
@endphp
@section('main')
<div class="row">
	<div class="col-12">
        <div class="box">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link {{Str::contains($currentRoute, 'suppliers.show') ? 'active' : ''}}" id="nav-basic-details-tab" 
                        href="{{route('suppliers.show',encrypt($id))}}" role="tab" > {{Str::contains($currentRoute, 'edit') ? 'Edit Profile' : 'Supplier Detail'}}</a>
                    <a class="nav-item nav-link {{Str::contains($currentRoute, 'bank') ? 'active' : ''}}" 
                        href="{{route('suppliers.bank',encrypt($id))}}" >Bank Detail</a>
                    <a class="nav-item nav-link {{Str::contains($currentRoute, 'suppliers.service') ? 'active' : ''}}" 
                        href="{{route('suppliers.service',encrypt($id))}}">Services Detail</a>
                    <a class="nav-item nav-link {{Str::contains($currentRoute,'suppliers.contactperson') ? 'active' : ''}}"
                        href="{{route('suppliers.contactperson',encrypt($id))}}" >Contact Persons</a>
                </div>
            </nav>
            <div class="box-body">
                <div class="tab-content py-2" id="nav-tabContent">
                    @yield('profile')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection