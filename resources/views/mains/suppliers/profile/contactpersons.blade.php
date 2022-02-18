@extends('mains.suppliers.show')
@php
    $type          = 'supplier';
@endphp
@section('profile')

    <x-contacts :type=$type :model="$supplier" :id="$id"/>

@endsection

@push('scripts')


@endpush


