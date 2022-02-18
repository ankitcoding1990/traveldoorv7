@extends('mains.suppliers.show')
@php
    $type          = 'supplier';
@endphp
@section('profile')

    <x-services.services :type="$type" :supplier="$supplier" />

@endsection

@push('scripts')


@endpush


