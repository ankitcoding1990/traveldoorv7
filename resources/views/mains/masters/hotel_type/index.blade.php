@extends('layouts.main')

@section('title','Hotel Type')

@section('main')
@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Hotel Type</h4>
                </div>
                <div class="box-body">
                    @if (isset($hotelType))
                        {!! Form::model($hotelType, ['method' => 'put', 'class' => 'package_form','route' => ['hotel_type.update', $hotelType->id]]) !!}
                        @include('mains.masters.hotel_type._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form' ,'class' => 'package_form']) !!}
                        @include('mains.masters.hotel_type._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="submit"  id="save_hotel_type" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                                </div>
                            </div>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->hasViewPermission($routeName))
    @isset($dataTable)
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">View hotel Type</h4>
                </div>
                <div class="box-body">
                    <div class="box service-tab">
                        <ul class="nav nav-tabs">
                            <li>
                                <a class="nav-link" href="{{route('hotel_type.index',['active'])}}">Active</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('hotel_type.index',['inactive'])}}">Inactive</a>
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
@endif
    <script>
        $(document).on('submit','.package_form', function(){
            event.preventDefault()
            if(Validate()){
                ajaxFormSubmit($(this))
            }
        })

        function softdelete(id, changeTo){
            console.log($(this));
            // var route = "{!! url('hotel_type' ) !!}" + "/" + id;
            // softDelete(route,id,changeTo)
        }
    </script>
@endpush
