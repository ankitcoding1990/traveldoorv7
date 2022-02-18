@extends('layouts.main')
@section('title', 'Guide Services')

@section('main')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Guide</h4>
                    @if (auth()->user()->hasAddPermission($routeName))
                        <a class="btn btn-info pull-right" href="{{ route('guides.create') }}"><i class="fa fa-plus"
                                aria-hidden="true"></i> Create New
                            Guide</a>
                    @endif
                </div>
                <div class="box-body">
                    @if (auth()->user()->hasViewPermission($routeName))
                        @isset($dataTable)
                            <div class="row">
                                <div class="col-12">
                                    <div class="box">
                                        <div class="box-body">
                                            <div class="table-responsive">
                                                {!! $dataTable->table() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endisset
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
