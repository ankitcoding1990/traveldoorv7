@extends('layouts.sightseeings')
@php
    $route = \Route::currentRouteName();
    $action = ['sightseeings.publish',$id];
    $button = '<i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Publish';
@endphp
@push('style')
    <style>
        .seprate {
            border-right: 1px solid rgb(182, 182, 182);
        }
        .navbar-gray {
            background: #ddd !important;
        }
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff !important;
            background-color: #2c4c87 !important;
        }
        .nav-link {
            border-right: 1px solid rgba(9, 9, 9, 0.212) !important;
        }
    </style>
@endpush
@section('content')
    {!! Form::open(['id' => 'sightseens_finish','route' => $action, 'method' => 'post']) !!}

       

        <button class="btn btn-warning my-3 pull-right" >{!! $button !!}</button>
    {!! Form::close() !!}
@endsection
@push('scripts')
    <script>
        // select2-selection
       $(document).on('submit','#sightseens_finish',function(e){
            e.preventDefault()
            if(Validate()){
                ajaxFormSubmit($(this))
            }
        })
        </script>
      
@endpush
