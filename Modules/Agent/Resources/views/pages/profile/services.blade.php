@extends('agent::layouts.profile')

@section('title', 'Services | Agent Profile')
@php
    $isAgent = true;
@endphp
@section('profile')
<x-services.services type="agent" :agent="$agent" />
@endsection