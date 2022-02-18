@extends('supplier::layouts.master')
@push('style')
<style>
     th[title='Action']{
            min-width: 6rem !important;
        }
    table{
        width: 100% !important;
    }
</style>
@endpush
@php
    $routeFor = Route::currentRouteName() == 'activity.index' ? 'undrafted' : 'drafted';;
@endphp
@section('breadcrumb-button')
        <a class="btn btn-info pull-right mx-2" href="{{ route('activity.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New
            Activity</a>
    @if ($routeFor == 'undrafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ url('supplier/activity-draft') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Drafted</a>
    @endif
@endsection
@section('title', 'Activities')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
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
                </div>
                @if (\Route::currentRouteName() != 'activity.index')
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3">
                                <a href="{{ url()->previous() }}" class="btn btn-success"><i class="fa fa-backward"
                                        aria-hidden="true"></i> Back</a>
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
    function delColumn(id){
        var token = $("meta[name='csrf-token']").attr("content");
        var text       = "Once deleted, you will not be able to recover this activity service!";
        var swalType   = 'warning';
        var ajaxType   = 'delete';
        var url        = "{!! url('services/activities' ) !!}" + "/" + id;
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }

    function ChangeColumnState(columnName, activityId, state) {
        var token = csrfToken();
        var text = 'Change '+columnName+' to '+state;
        var swalType = 'info';
        var ajaxType = 'post';
        var url = "{{ url('activity/state') }}";
        var data = {'_token':token, 'column' : columnName, 'activity_id' : activityId,'state' : state}
        ConfirmSwal(text,swalType,ajaxType,url,data)
    }
</script>
@endpush
