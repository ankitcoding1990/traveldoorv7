@extends('layouts.main')

@section('title','Menus')

@section('subtitle','Menus')

@php
  $breadcrumbs = [
    [
      'title' =>  'Menus',
      'link'  =>  route('menus.index'),
    ],
    [
      'title' =>  'List of menus',
      'link'  =>  '',
    ],
  ];
@endphp

@push('style')

@endpush
@section('breadcrumb-button')
  <a href="{{ route('menus.create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Create New</a>  
@endsection

@section('main')
  <div class="row">
      <div class="col-12">
          <div class="box">
              <div class="box-body">
                @isset($dataTable)
                  {!! $dataTable->table() !!}
                @endisset
              </div>
          </div>
      </div>
  </div>
@endsection

@push('scripts')
  @isset($dataTable)
    {!! $dataTable->scripts() !!}
  @endisset
@endpush
