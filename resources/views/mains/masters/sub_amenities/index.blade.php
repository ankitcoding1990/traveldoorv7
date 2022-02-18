@extends('layouts.main')

@section('title', 'Sub-amenities')
@section('main')

    @if (auth()->user()->hasAddPermission($routeName))
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Add New Sub Amenities</h4>
                    </div>
                    <div class="box-body">
                        @if (isset($SubAmenities))
                            {!! Form::model($SubAmenities, ['method' => 'put', 'class' => 'package_form', 'route' => ['sub_amenities.update', $SubAmenities->id]]) !!}
                            @include('mains.masters.sub_amenities._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="submit"
                                        class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                                </div>
                            </div>
                        @else
                            {!! Form::open(['class' => 'package_form', 'method' => 'post', 'id' => 'menu_form']) !!}
                            @include('mains.masters.sub_amenities._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="submit" id="save_amenities"
                                        class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                                </div>
                            </div>
                        @endif

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if (auth()->user()->hasViewPermission($routeName))
        @isset($dataTable)
            <div class="row">
                <div class="col-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h4 class="box-title">View Amenities</h4>
                        </div>
                        <div class="box-body">
                            <div class="box service-tab">
                                <ul class="nav nav-tabs">
                                    <li>
                                        <a class="nav-link" href="{{route('sub_amenities.index',['active'])}}">Active</a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="{{route('sub_amenities.index',['inactive'])}}">Inactive</a>
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
    <script>
        $(document).on('submit', '.package_form', function() {
            event.preventDefault();
            if (Validate()) {
                ajaxFormSubmit($(this))
            }
        })



    </script>
@endpush
