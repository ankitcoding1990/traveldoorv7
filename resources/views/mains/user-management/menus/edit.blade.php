@extends('layouts.main')

@section('title','Menus')

@section('subtitle','Create New Menu')

@php
  $breadcrumbs = [
    [
      'title' =>  'Menus',
      'link'  =>  route('menus.index'),
    ],
    [
      'title' =>  'Create ',
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

                  <a href="{{ route('menus.index') }}" class="btn btn-primary float-right"> <i class="fa fa-list"></i> View Users</a>
              </div>
              <div class="box-body">
                {!! Form::model($menu,['route' => ['menus.update', $menu->id], 'method' => 'put', 'autocomplete' => 'off' ,'id' => 'sub_menu_form', 'class' => 'package_form', 'onsubmit="ajaxFormSubmit($(this))"']) !!}

                  @include('mains.user-management.menus._form')
                  <div class="mt-2">
                    <button type="submit" class="btn btn-rounded btn-primary mr-10">Update</button>
                    <button type="button" onclick="discard()" class="btn btn-rounded btn-dark">Discard</button>
                  </div>

                {!! Form::close() !!}
              </div>
          </div>
      </div>
  </div>
@endsection
