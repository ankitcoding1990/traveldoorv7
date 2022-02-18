@extends('agent::layouts.profile')

@section('title', 'Contacts | Agent Profile')

@section('profile')
  <x-contacts type="agent" :model="$agent" :isAgent=true />
@endsection
