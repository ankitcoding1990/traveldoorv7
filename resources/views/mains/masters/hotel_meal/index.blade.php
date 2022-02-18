@extends('layouts.main')

@section('title','Hotel Meal');
@section('main')

    @if(auth()->user()->hasAddPermission($routeName))
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        @if (isset($hotelmeal))
                            {!! Form::model($hotelmeal, ['method' => 'put','class' => 'package_form','route' => ['hotelmeal.update', $hotelmeal->id]]) !!}
                            @include('mains.masters.hotel_meal._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="submit"  class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                                </div>
                            </div>
                        @else
                            {!! Form::open(['method' => 'post' , 'class' => 'package_form', 'id' => 'menu_form']) !!}
                            @include('mains.masters.hotel_meal._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="submit"  id="save_hotel_meal" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                        <div class="box-body">
                            <div class="box service-tab">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a class="nav-link" href="{{route('hotelmeal.index',['active'])}}">Active</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{route('hotelmeal.index',['inactive'])}}">Inactive</a>
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
    @endif

@endsection

@push('scripts')
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset
<script>

    $(document).on('submit', '.package_form', function(){
        event.preventDefault();
        if(Validate()){
            ajaxFormSubmit($(this))
        }
    })
    
    // function ChangeState(id, state) {
    //     var token = csrfToken();
    //     var text = 'Change status to '+state;
    //     var swalType = 'info';
    //     var ajaxType = 'get';
    //     var url = "{{ url('/hotelmeals/state') }}";
    //     var data = {state : state, _token : token, id: id}
    //     ConfirmSwal(text,swalType,ajaxType,url,data)
    // }
    </script>
@endpush
