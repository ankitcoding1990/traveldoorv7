@extends('layouts.main')

@section('title','Activity Type')

@section('main')
@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Activity Type</h4>
                </div>
                <div class="box-body">
                    @if (isset($activityType))
                        {!! Form::model($activityType, ['method' => 'put', 'class' => 'package_form','route' => ['activity_type.update', $activityType->id]]) !!}
                        @include('mains.masters.activity_type._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form' ,'class' => 'package_form']) !!}
                        @include('mains.masters.activity_type._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="button"  id="save_activity_type" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                {{-- <div class="box-header with-border">
                    <h4 class="box-title">View activity Type</h4>
                </div> --}}
                <div class="box-body">
                    <div class="box service-tab">
                        <ul class="nav nav-tabs">
                            <li>
                                <a class="nav-link" href="{{route('activity_type.index',['active'])}}">Active</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('activity_type.index',['inactive'])}}">Inactive</a>
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

        $(document).on('keydown','#activity_type_name',function (e) {  
            var code = e.keyCode;
            if(code == 13) {
                $("#save_activity_type").trigger("click");
            }
        });

        $(document).on('click','#save_activity_type',function(){
            event.preventDefault();
            var activity_type_name = $('#activity_type_name').val();
            var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
            if(activity_type_name.trim() == "")
            {
                $("#activity_type_name").css("border","1px solid #cf3c63");
                $("#activity_type_name").focus();
                if(!$('.error-msg').length > 0)
                    $("#activity_type_name").parent('div').append(error)
                return false;
            }
            else
            {
                $("#activity_type_name").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            $("#save_activity_type").prop("disabled", true);
            var data = new FormData($('#menu_form')[0]);
            $.ajax({
                url: "{{route('activity_type.store')}}",
                data: data,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    swal(response[1],response[0],response[1])
                    $('.dataTable ').DataTable().ajax.reload();
                    $("#menu_form")[0].reset();
                    $("#save_activity_type").prop("disabled", false);
                }
            });
        })

    </script>
@endpush
