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
@section('breadcrumb-button')
<a href="{{ route('users.create') }}" class="btn btn-primary float-right"> <i class="fa fa-plus"></i> Create New</a>
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

  <script>
    function ChangeUserState(id, state) {
        var token = csrfToken();
        var text = 'Change status to '+state;
        var swalType = 'info';
        var ajaxType = 'get';
        var url = "{{ url('/user/state') }}";
        var data = {state : state, _token : token, id: id}
        ConfirmSwal(text,swalType,ajaxType,url,data)
    }
  </script>

@endpush
