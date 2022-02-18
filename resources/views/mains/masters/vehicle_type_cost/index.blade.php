@extends('layouts.main')
@push('style')

@endpush

@section('main')
@section('title','Vehicle Type Cost')

@if(auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                @if(isset($vehicleTypeCost))
                {!! Form::model($vehicleTypeCost, ['method' => 'put', 'class' => 'package_form','route' => ['vehicles_type_cost.update', $vehicleTypeCost->id]]) !!}
                @include('mains.masters.vehicle_type_cost._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
                @else
                {!! Form::open(['method' => 'post', 'id' => 'menu_form', 'class' => 'package_form']) !!}
                    @include('mains.masters.vehicle_type_cost._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit"  id="save_vehicle_type" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                        </div>
                    </div>
                @endif
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@isset($dataTable)
 <div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">View Vehicle Type Cost</h4>
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
<h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection

@push('scripts')
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset

<script>

    $(document).on('submit','.package_form', function(){
        event.preventDefault()
        if(Validate()){
            ajaxFormSubmit($(this))
        }
    })
    function delUser(id){
        var token = $("meta[name='csrf-token']").attr("content");
        var text       = "Once deleted, you will not be able to recover this cost!";
        var swalType   = 'warning';
        var ajaxType   = 'delete';
        var url        = "{!! url('vehicles_type_cost' ) !!}" + "/" + id;
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }
</script>
@endpush
