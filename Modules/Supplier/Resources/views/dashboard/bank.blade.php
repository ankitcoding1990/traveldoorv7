@extends('supplier::layouts.profile')

@section('title', 'Supplier Profile')
@php
    $type          = 'supplier';
    $currentRoute  = Route::currentRouteName();
    $isSupplier    = true;
@endphp
@section('profile')

    <x-bank.banks :type=$type :supplier="$supplier" :isSupplier="$isSupplier"/>

@endsection

@push('scripts')


@endpush


