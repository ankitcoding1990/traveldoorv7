@extends('layouts.main')

@section('title','User Management')

@section('subtitle','Edit User')

@php
  $breadcrumbs = [
    [
      'title' =>  'Users',
      'link'  =>  route('users.index'),
    ],
    [
      'title' =>  'Edit User ',
      'link'  =>  '',
    ],
  ];
@endphp

@push('style')

@endpush

@section('main')
  <div class="row">
      <div class="col-12">
          <div class="box">
              <div class="box-header with-border">

                  <a href="{{ route('users.index') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> View Users</a>
                  <h4>Create New User</h4>
              </div>
              <div class="box-body">
                {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put', 'autocomplete' => 'off' ,'id' => 'userForm']) !!}
                    @include('mains.user-management.users._form')

                    <button type="submit" class="btn btn-rounded btn-primary mr-10">Update</button>
                    <button type="button" onclick="discard()" class="btn btn-rounded btn-dark">Discard</button>
                {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
