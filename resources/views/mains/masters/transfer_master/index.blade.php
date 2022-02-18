@extends('layouts.main')

@section('title','Transfer Master')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New Transfer Master</h4>
            </div>
            <div class="box-body">
                @if (isset($transferMaster))
                    {!! Form::model($transferMaster, ['method' => 'put', 'class' => 'package_form','route' => ['transfer_master.update', $transferMaster->id]]) !!}
                    @include('mains.masters.transfer_master._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="Submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
                @else
                {!! Form::open(['class' => 'package_form', 'method' => 'post', 'id' => 'menu_form']) !!}
                @include('mains.masters.transfer_master._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" id="save_master" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                        </div>
                    </div>
                @endif

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endif
@if(auth()->user()->hasViewPermission($routeName))
@isset($dataTable)
<div class="row" id="master_table">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title table_title">View Masters</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    {!! $dataTable->table() !!}
                </div>
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
{{--
@if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
@endif --}}

@isset($transferMaster)
    <script>
        $(document).ready(function(){
            fetchCities('{{ $transferMaster->master_country }}','{{ $transferMaster->master_city }}');
        })
    </script>
@endisset

@isset($dataTable)
    {!! $dataTable->scripts() !!}
  @endisset
<script>

    $(document).on('submit','.package_form', function(){
        event.preventDefault();
        if(Validate()){
            ajaxFormSubmit($(this))
        }
    })
    function fetchCities(country, selected = null){
        $.ajax({
            url:'{{url("/get-cities")}}',
            dataType: 'JSON',
            method: 'get',
            data: {'country': country},
            success: function (response){
                if(response)
                {
                    html ='<option disabled selected hidden>--Select City--</option>'
                    $.each(response,function(key, value){
                        if(selected == key){
                            html += `<option selected value = ${key} >${value}</option>`
                        }
                        else{
                            html += `<option value = ${key} >${value}</option>`
                        }
                    })
                }
                else{
                    html = '<option disabled selected hidden>--No Avalaible City For This Country--</option>'
                }
                $('#master_city').html(html)
            }
        })
    }

    function delColumn(id){
        var token = $("meta[name='csrf-token']").attr("content");
        var text       = "Once deleted, you will not be able to recover this transfer master!";
        var swalType   = 'warning';
        var ajaxType   = 'delete';
        var url        = "{!! url('transfer_master' ) !!}" + "/" + id;
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }

    function ChangeState(id, state) {
        var token = csrfToken();
        var text = 'Change status to '+state;
        var swalType = 'info';
        var ajaxType = 'get';
        var url = "{{ url('/transfer_masters/state') }}";
        var data = {state : state, _token : token, id: id}
        ConfirmSwal(text,swalType,ajaxType,url,data)
    }

</script>

@endpush
