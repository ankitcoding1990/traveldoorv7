@extends('supplier::layouts.master')

@php
    $route=Route::currentRouteName();
    if($route=='supplier.restaurant.drafted'){
        $routeFor = 'drafted';
    }else{
        $routeFor = 'undrafted';
    }
@endphp

@section('breadcrumb-button')
    
        <a class="btn btn-info pull-right mx-2" href="{{ route('restaurant.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New Restaurant</a>
    
    @if ($routeFor == 'undrafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('supplier.restaurant.drafted') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Drafted</a>
        @section('title','Restaurants')
    @elseif($routeFor == 'drafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('restaurant.index') }}"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
        @section('title','Restaurants (Drafted)')
    @endif
@endsection

@section('content')
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
@endsection

@push('scripts')
    @isset($dataTable)
        {!! $dataTable->scripts() !!}
    @endisset

    <script>
        function delColumn(id){
            var token = $("meta[name='csrf-token']").attr("content");
            var text       = "Once deleted, you will not be able to recover this restaurant service!";
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