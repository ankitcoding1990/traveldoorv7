@extends('mains.agents.show')
@php
    $type          = 'agent';
@endphp
@section('profile')
    <x-services.services :type="$type" :agent="$agent" />

@endsection

@push('scripts')


@endpush


