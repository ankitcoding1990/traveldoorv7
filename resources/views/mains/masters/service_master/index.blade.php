@extends('layouts.main')
@push('style')
    <style>
        th[title=Action]{
            width: 235px !important;
        }
    </style>
@endpush
@section('title','Service Management')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    @isset($dataTable)
    <div class="row" id="table_div">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">All Services</h4>
                    @if (true)
                        <a href="{{route('service_master.create')}}" class="btn btn-primary mr-10 pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Service</a>
                    @endif
                </div>
                <div class="box-body">
                    <div class="box service-tab">
                        <ul class="nav nav-tabs">
                            <li>
                                <a class="nav-link" href="{{route('service_master.index',['active'])}}">Active</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('service_master.index',['inactive'])}}">Inactive</a>
                            </li>
                        </ul>
                    </div>
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
@else
    <h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection

@push('scripts')
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset
@if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
  @php
      session()->forget('status');
  @endphp
@endif

@endpush
