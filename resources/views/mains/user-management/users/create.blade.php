@extends('layouts.main')

@section('title','User Management')

@section('subtitle','Users & Partners')

@php
  $breadcrumbs = [
    [
      'title' =>  'Users',
      'link'  =>  route('users.index'),
    ],
    [
      'title' =>  'List of Users & Partners ',
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
                {!! Form::open(['route' => 'users.store', 'method' => 'post', 'autocomplete' => 'off' ,'id' => 'userForm']) !!}
                    @include('mains.user-management.users._form')

                  <button type="submit"  id="create_user" class="btn btn-rounded btn-primary mr-10">Create</button>
                  <button type="button" onclick="discard()" class="btn btn-rounded btn-dark">Discard</button>
                {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
