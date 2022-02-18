@extends('agent::layouts.profile')

@section('title', 'Password | Agent Profile')

@section('profile')
  <x-password-change  type="agent" :model="$agent" />
@endsection
