@extends('layouts.main')

@section('title','Tour Type')

@section('main')
@if(true)
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Tour Type</h4>
                </div>
                <div class="box-body">
                    @if (isset($tourType))
                        {!! Form::model($tourType, ['method' => 'put', 'class' => 'package_form','route' => ['tour_type.update', $tourType->id]]) !!}
                        @include('mains.masters.tour_type._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form' ,'class' => 'package_form']) !!}
                        @include('mains.masters.tour_type._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="button"  id="save_tour_type" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                <div class="box-body">
                    <div class="box service-tab">
                        <ul class="nav nav-tabs">
                            <li>
                                <a class="nav-link" href="{{route('tour_type.index',['active'])}}">Active</a>
                            </li>
                            <li>
                                <a class="nav-link" href="{{route('tour_type.index',['inactive'])}}">Inactive</a>
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
        $(document).on('click','#save_tour_type',function(){
            var tour_type_name = $('#tour_type_name').val();
            var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
            if(tour_type_name.trim() == "")
            {
                $("#tour_type_name").css("border","1px solid #cf3c63");
                $("#tour_type_name").focus();
                if(!$('.error-msg').length > 0)
                    $("#tour_type_name").parent('div').append(error)
                return false;
            }
            else
            {
                $("#tour_type_name").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            $("#save_tour_type").prop("disabled", true);
            var data = new FormData($('#menu_form')[0]);
            $.ajax({
                url: "{{route('tour_type.store')}}",
                data: data,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    swal(response[1],response[0],response[1])
                    $('.dataTable ').DataTable().ajax.reload();
                    $("#menu_form")[0].reset();
                    $("#save_tour_type").prop("disabled", false);
                }
            });
        });

        function delColumn(id){
            var token = $("meta[name='csrf-token']").attr("content");
            var text       = "Once deleted, you will not be able to recover this tour type!";
            var swalType   = 'warning';
            var ajaxType   = 'delete';
            var url        = "{!! url('tour_type' ) !!}" + "/" + id;
            var data       = {'_token': token,'id':id, 'status':'permanent'};
            ConfirmSwal(text,swalType,ajaxType,url,data,true);
        }

        function ChangeState(id, state) {
            alert('ok');
            // var route = "{!! url('tour_type' ) !!}" + "/" + id;
            // softDeletes(route,id,state)
        }
    </script>
@endpush