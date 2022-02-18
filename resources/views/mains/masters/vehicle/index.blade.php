@extends('layouts.main')

@section('title','Vehicle')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Vehicle</h4>
                </div>
                <div class="box-body">
                    @if (isset($vehicle))
                        {!! Form::model($vehicle, ['method' => 'put', 'class' => 'package_form','route' => ['vehicle.update', $vehicle->id]]) !!}
                        @include('mains.masters.vehicle._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form' ,'class' => 'package_form']) !!}
                        @include('mains.masters.vehicle._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="button"  id="save_vehicle" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                    <h4 class="box-title">View Vehicle</h4>
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

    @if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
@endif
    <script>
        $(document).on('click','#save_vehicle',function(){
            var vehicle_name = $('#vehicle_name').val();
            var vehicle_type_id = $('#vehicle_type_id').val();
            var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
            if(vehicle_type_id == "")
            {
                $("#vehicle_type_id").css("border","1px solid #cf3c63");
                $("#vehicle_type_id").focus();
                if(!$('.error-msg').length > 0)
                    $("#vehicle_type_id").parent('div').append(error)
                return false;
            }
            else
            {
                $("#vehicle_type_id").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            if(vehicle_name.trim() == "")
            {
                $("#vehicle_name").css("border","1px solid #cf3c63");
                $("#vehicle_name").focus();
                if(!$('.error-msg').length > 0)
                    $("#vehicle_name").parent('div').append(error)
                return false;
            }
            else
            {
                $("#vehicle_name").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            $("#save_vehicle").prop("disabled", true);
            var data = new FormData($('#menu_form')[0]);
            $.ajax({
                url: "{{route('vehicle.store')}}",
                data: data,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    swal(response[1],response[0],response[1])
                    $('.dataTable ').DataTable().ajax.reload();
                    $("#menu_form")[0].reset();
                    $("#save_vehicle").prop("disabled", false);
                }
            });
        })
       
    </script>
@endpush
