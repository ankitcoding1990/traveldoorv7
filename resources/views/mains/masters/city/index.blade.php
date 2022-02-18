@extends('layouts.main')

@section('title','Cities')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    @isset($state)
        <input type="hidden" id="state" value="{{$state}}">
    @endisset
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Select Country</h4>
                </div>
                <div class="box-body">
                    @php
                        if(isset($id)){
                            $selected = $id;
                        }
                        else{
                            $selected = null;
                        }
                    @endphp
                    {!! Form::open(['method' => 'get', 'id' => 'menu_form', 'class' => 'package_form', 'route' => 'cities.index' ,'onsubmit' => 'ajaxFormSubmit1()']) !!}
                    <div class="row">
                        <div class="col-5">
                            <label for="country_name0">Countries</label>
                            {!! Form::select('country',$countries, $selected, ['class' => 'form-control', 'id' => 'country','placeholder' => '--Select Country--']) !!}
                        </div>
                        <div class="col-sm-5">
                            <label for="states">States</label>
                            <select name="state_id" class="form-control" id="states" autofocus>
                                <option disabled selected hidden value=""> -- Select Country First --</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" id="get_data" class="btn btn-rounded btn-primary mr-10 pull-right">Get Cities</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->hasViewPermission($routeName))
    @isset($dataTable)
    <div class="row" id="table_div">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">View/Edit Cities</h4>
                    <button type="button" id="add-new-city"  data-toggle="modal" data-target="#myModal" class="btn btn-primary mr-10 pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New City</button>
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

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add New City</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            {!! Form::open([ 'id' => 'city_form', 'class' => 'package_form']) !!}
                @include('mains.masters.city._form')
            {!! Form::close() !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right mx-1" data-dismiss="modal">Close</button>
            <button type="button" id="save_city" class="btn btn-info mx-1 pull-right submit">Submit</button>
        </div>
      </div>

    </div>
  </div>
@endsection

@push('scripts')
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset

<script>
    $(document).ready(function(){
        var selector = $('#country');
        getStates(selector);
    })
    $(document).on('change','#country_id, #country',function(){
        getStates(this)
    })

    $(document).on('click','#save_city',function(){
        var id         = $("#city_id").val();
        if(id){
            var id = $('#city_id').val()
            var url = "{!! url('cities' ) !!}" + "/" + id
            var method = 'put'
            submitData(url,method)
        }
        else{
            var url = "{{route('cities.store')}}";
            var method = 'post'
            submitData(url,method)
        }
    })
    function resetData(){
        if($('.error-msg').length > 0){
            $('.error-msg').remove()
        }
        $('#city_id').val('')
        $('#city').val('')
        $('select option[disabled]').prop('selected',true)
        $('.modal-title').text('Add New City')
        if($('submit').length > 0){
            $('#save_city').removeClass('update');
            $('#save_city').addClass('submit');
        }
    }
    function fillData(id,city,state_id){
        if($('.error-msg').length > 0){
            $('.error-msg').remove()
        }
        $('#city_id').val(id)
        $('#city').val(city)
        $('select option[value='+state_id+']').prop('selected',true)
        $('.modal-title').text('Edit City')
        $('#save_city').removeClass('submit');
        $('#save_city').addClass('update');
    }
    function getStates(event){
        var country = $(event).val();
        var html = "";
        if(country != ""){
            $.ajax({
                method:'get',
                url:'{{url("/get_states")}}',
                data:{'country': country},
                success: function(response){
                    if(response){
                       html = '<option disabled selected value=""> -- Select State -- </option>';
                       $.each(response,function(key, item){
                           html += `<option value = ${key}> ${item} </option>`;
                       })
                    }
                    else{
                        html = '<option disabled selected value=""> -- No states for this country -- </option>'
                    }
                    $('#states').html(html)

                    var state = $('#state').val();
                    if(state) {
                        $('#states').val(state);
                    }
                }
            })
        }
    }


    function ajaxFormSubmit1() {
        event.preventDefault();
        var country  = $('#country').val();
        if(country == ''){
            $('#country').css('border','1px red solid')
            return false;
        }
        var states   = $('#states').val();
        if(states == '' || states == null) {
            $('#states').css('border','1px red solid');
            return false;
        }
        window.location.href = "{!! url('cities' ) !!}?country="+country+"&state_id="+states;
    }

    $(document).on('keydown','#city',function (e) {
        var code = e.keyCode;
        if(code == 13) {
            $("#save_city").trigger("click");
        }
    });

    function submitData(address,method){
        var states = $('#states').val()
        var city = $('#city').val()
        var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
        if(states == "" || states == null)
        {
            $("#states").css("border","1px solid #cf3c63");
            $("#states").focus();
            if(!$('.error-msg').length > 0)
                $("#states").parent('div').append(error)
            return false;
        }
        else
        {
            $("#states").css("border","1px solid #9e9e9e");
            if($('.error-msg').length > 0)
                $('.error-msg').remove();
        }
        if(city.trim() == "")
        {
            $("#city").css("border","1px solid #cf3c63");
            $("#city").focus();
            if(!$('.error-msg').length > 0)
                $("#city").parent('div').append(error)
            return false;
        }
        else
        {
            $("#city").css("border","1px solid #9e9e9e");
            if($('.error-msg').length > 0)
                $('.error-msg').remove();
        }

        var name       = $('#city').val();
        var country_id = $('#country').val();
        var token      = $("meta[name='csrf-token']").attr("content");
        var id         = $("#city_id").val();
        var formdata = {
            'id'       : id,
            'state_id' : states,
            'name'     : name,
            'country_id': country_id
        };
        $('#myModal').modal('toggle');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': token
            },
            url: address,
            type: method,
            data: formdata,
            success: function (response){
                $("#city_id").val(null);
                $('#city').val('');
                swal(response[1],response[0],response[1])
                $('.dataTable').DataTable().ajax.reload();
                window.location.reload();
            }
        });

    }

    function delColumn(id){
        var token      = $("meta[name='csrf-token']").attr("content");
        var text       = "Once deleted, you will not be able to recover this city!";
        var swalType   = 'warning';
        var ajaxType   = 'delete';
        var url        = "{!! url('city' ) !!}" + "/" + id;
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }
</script>
@endpush
