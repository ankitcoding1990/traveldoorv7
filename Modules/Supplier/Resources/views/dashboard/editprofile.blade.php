
@extends('supplier::layouts.profile')

@section('title', 'Supplier Profile')
@php
    $type          = 'supplier';
    $currentRoute  = Route::currentRouteName();
@endphp
@section('profile')

<x-suppliers.form :isAdmin=true :supplier="$supplier"/>

@endsection

@push('scripts')


@endpush

