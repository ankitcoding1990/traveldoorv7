@extends('mains.agents.show')
@php
    $type          = 'agent';
@endphp
@section('profile')

    <x-contacts :type=$type :model="$agent" :id="$id"/>

@endsection

@push('scripts')


@endpush


