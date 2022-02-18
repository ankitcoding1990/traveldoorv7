@extends('layouts.main')
@push('style')
    <style>
        th[title='Action']{
            min-width: 8rem !important;
        }
    </style>
@endpush
@php
    $routeFor = \Route::currentRouteName() == 'activities.index' ? 'undrafted' : 'drafted';
@endphp
@section('breadcrumb-button')
    @if (auth()->user()->hasAddPermission($routeName))
        <a class="btn btn-info pull-right mx-2" href="{{ route('activities.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New
            Activity</a>
    @endif
    @if ($routeFor == 'undrafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('activity-draft') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Drafted</a>
    @endif
@endsection
@if ($routeFor == 'undrafted')
    @section('title','Activity Services')
@else
    @section('title','Activity Services(drafted)')
@endif
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="box">
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
                @if (\Route::currentRouteName() != 'activities.index')
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="{{ url()->previous() }}" class="btn btn-success"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @isset($dataTable)
        {!! $dataTable->scripts() !!}
    @endisset

    <script>
        
        function ChangeColumnState(columnName, activityId, state) {
            var token = csrfToken();
            var text = 'Change '+columnName+' to '+state;
            var swalType = 'info';
            var ajaxType = 'post';
            var url = "{{ url('activity/state') }}";
            var data = {'_token':token, 'column' : columnName, 'activity_id' : activityId,'state' : state}
            ConfirmSwal(text,swalType,ajaxType,url,data)
        }

        function CloneActivity(id){
            var token      =  csrfToken()
            var text       = "Do you want to copy this activity";
            var swalType   = 'info';
            var ajaxType   = 'get';
            var url        = "{!! url('service/activity/copy') !!}" + '/' + id;
            var data       = {'_token': token,'id':id};
            ConfirmSwal(text,swalType,ajaxType,url,data);
        }
    </script>
@endpush
