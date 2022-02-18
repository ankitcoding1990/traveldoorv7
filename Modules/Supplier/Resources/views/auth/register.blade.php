@extends('supplier::layouts.register')

@section('title', 'Create New Account')

@push('style')

  <style>
    .srl-navbar{
      display: inline-block;
      width : 100px;
    }
    .srl-logo img{
      width: 101px!important;
      height: 76px;

    }
      .file{
          border: 2px dashed #aaa;
          text-align: center;
          padding: 4px;
      }
      .file > label{
          color: #aaa;
          padding: 4.6rem;
      }
      .file > img{
          max-width: calc(30rem + 5vw);
          display: block;
          max-height: calc(20rem + 3vh);
          margin: auto;
      }
  </style>
@endpush

@section('content')
  <div class="container my-4">
      <h3 class="font-weight-bold text-info">Create New Account </h3>
      <p>Please fill * required fileds.</p>
      <div class="jumbotron bg-white border-rounded">
          {!! Form::open(['id' => 'register_supplier_form', 'route'=>'supplier.create', 'method' => 'POST','files' => 'true' ]) !!}
          <x-suppliers.form :isAdmin=true />
          {!! Form::close() !!}
      </div>
  </div>
@endsection
