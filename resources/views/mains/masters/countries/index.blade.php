@extends('layouts.main')
@section('title', 'countries')
@section('main')
    @if (auth()->user()->hasViewPermission($routeName))
        @isset($dataTable)
            <div class="temp"></div>
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">All Countries</h4>
                        </div>
                        <div class="box-body">
                            <div class="table-responsive">
                                {!! $dataTable->table() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    @else
        <h4 class="text-danger">No rights to access this Report</h4>
    @endif
@endsection

<x-world type="countries"/>
@push('scripts')
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset
@endpush
