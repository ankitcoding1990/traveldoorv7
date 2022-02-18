@extends('supplier::layouts.profile')

@section('title', 'Supplier Profile')
@php
    $type          = 'supplier';
    $currentRoute  = Route::currentRouteName();
@endphp
@section('profile')

    <x-services.services :type="$type" :supplier="$supplier" />

@endsection

@push('scripts')


@endpush


