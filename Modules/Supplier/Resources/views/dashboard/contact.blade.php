@extends('supplier::layouts.profile')

@section('title', 'Supplier Profile')
@php
    $type          = 'supplier';
    $currentRoute  = Route::currentRouteName();
@endphp
@section('profile')

    <x-contacts :type=$type :model="$supplier" />

@endsection

@push('scripts')


@endpush


