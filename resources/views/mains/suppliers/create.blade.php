@extends('layouts.main')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Create Supplier</h4>
                </div>
                @php
                    $admin = false;
                @endphp
                <div class="box-body">
                    @isset($supplier)
                        <x-suppliers.form :isAdmin="$admin" :supplier="$supplier"/>
                    @else 
                        {!! Form::open(['id' => 'register_supplier_form', 'route'=>'suppliers.store', 'method' => 'POST','files' => 'true' ]) !!}
                            <x-suppliers.form :isAdmin="$admin"/>
                        {!! Form::close() !!}   
                    @endisset
                </div>
            </div>
        </div>
    </div>
@endsection
