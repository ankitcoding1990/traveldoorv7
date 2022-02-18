@extends('layouts.main')
@push('style')
    <style>
        .actions{
        margin: 0px 5px;
    }
    th[title=Action]{
        width: 190PX !important;
    }
    </style>
@endpush
@section('title','Income')
@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Income Category</h4>
                </div>
                <div class="box-body">

                    @if (isset($data))
                        {!! Form::model($data, ['method' => 'put', 'class' => 'package_form','onsubmit="ajaxFormSubmit($(this))"','route' => ['incomes.update', $data->id]]) !!}
                        @include('mains.IncomeExpense.IncomeCategory._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['class'=>'package-form','method'=>'post', 'route' => 'incomes.store', 'onsubmit="ajaxFormSubmit($(this))"']) !!}
                        @include('mains.IncomeExpense.IncomeCategory._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit"  id="save_income_category" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                            </div>
                        </div>
                    @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @isset($dataTable)
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">View Income Category</h4>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                        {{$dataTable->table()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
@endif

@endsection

@push('scripts')
    @isset($dataTable)
        {{$dataTable->scripts()}}
    @endisset
@endpush