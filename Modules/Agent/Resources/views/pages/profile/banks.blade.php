@extends('agent::layouts.profile')

@section('title', 'Banks | Agent Profile')
{{-- @php
    $isAgent = true;
@endphp --}}
@section('profile')
  <x-bank.banks type="agent" :agent="$agent" :isAgent=true />
@endsection
