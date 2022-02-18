@extends('layouts.main')

@php
    $route=Route::currentRouteName();
    if($route=='restaurant.drafted'){
        $routeFor = 'drafted';
    }else{
        $routeFor = 'undrafted';
    }
@endphp
@section('breadcrumb-button')
    @if (auth()->user()->hasAddPermission($routeName))
        <a class="btn btn-info pull-right mx-2" href="{{ route('restaurants.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New Restaurant</a>
    @endif
    @if ($routeFor == 'undrafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('restaurant.drafted') }}"><i class="fa fa-briefcase" aria-hidden="true"></i> Drafted</a>
        @section('title','Restaurants')
    @elseif($routeFor == 'drafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('restaurants.index') }}"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
        @section('title','Restaurants (Drafted)')
    @endif
@endsection

@section('main')
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
        function ChangeColumnState(columnName, restaurantId, state) {
            var token = csrfToken();
            var text = 'Change '+columnName+' to '+state;
            var swalType = 'info';
            var ajaxType = 'post';
            var url = "{{ url('restaurant/change/status') }}";
            var data = {'_token':token, 'column' : columnName, 'restaurant_id' : restaurantId,'state' : state}
            ConfirmSwal(text,swalType,ajaxType,url,data)
        }
    </script>
@endpush