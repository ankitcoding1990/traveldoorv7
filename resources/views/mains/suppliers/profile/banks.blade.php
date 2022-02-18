@extends('mains.suppliers.show')
@php
    $type          = 'supplier';
@endphp
@section('profile')

    <x-bank.banks :type=$type :supplier="$supplier" :id="$id"/>

@endsection

@push('scripts')


@endpush


