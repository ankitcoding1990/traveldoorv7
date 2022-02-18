@extends('mains.agents.show')
@php
    $type = 'agent';
@endphp
@section('profile')
    <x-bank.banks :type=$type :agent="$agent" :id="$id"/>
@endsection

@push('scripts')


@endpush


