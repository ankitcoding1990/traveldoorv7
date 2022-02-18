@extends('layouts.main')

@section('title','Vehicle Suggested Price')
@section('main')

@if(auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Suggest Price for vehicle</h4>
            </div>
            <div class="box-body">
                {!! Form::open(['class' => 'package_form',"enctype" => "multipart/form-data",'method' => 'post','route' => 'vehicle_suggested_cost.store']) !!}
                <div class="row">
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="suggested_price_for">Suggested Price For <span class="asterisk">*</span></label>
                            {!! Form::select('suggested_price_for',['sightseeing' => 'Sightseeing','transfer' => 'Transfer'],'sightseeing', ['class' => 'form-control select','id' => 'suggested_price_for']) !!}
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label for="country">Country <span class="asterisk">*</span></label>
                            {!! Form::select('country', getCountries(1), null, ['Class' => 'form-control select','id' => 'country']) !!}
                        </div>
                    </div>
                    <div class="col-sm-5 transfer_div">
                        <div class="form-group">
                            <label for="">Transfer Type<span class="asterisk">*</span></label>
                            {!! Form::select('transfer_type', ['from-airport'=>'From Airport','to-airport'=>'To Airport','city-transfer'=>'City Transfer','from-border'=>'From Border','to-border'=>'To Border','from-railway'=>'From Railway','to-railway'=>'To Railway'], null, ['class' => 'form-control select','id' => 'transfer_type']) !!}
                        </div>
                    </div>
                    <div class="col-sm-5 city_div">
                        <div class="form-group">
                            <label for="">City<span class="asterisk">*</span></label>
                            <select name="city" id="city" class="form-control select">
                                <option value disabled selected hidden>--Select Country First--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-5 transfer_detail_div">
                        <div class="form-group">
                            <label for="transfer_type_detail" id="transfer_type_detail_label">Select Airport<span class="asterisk">*</span></label>
                            <select id="transfer_type_detail" name="transfer_type_detail" class="form-control select" style="width: 100%;">
                                <option value="0">Select Airport</option>
                            </select>
                        </div>
                    </div>
                </div>
                <center><img class="loader" src="\assets\images\loader.gif" style="width:40%"/></center>
                <div class="form m-2">
                    <div id="menu_form">

                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" id="save_prices" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@else
<h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection

@push('scripts')
@if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
@endif
<script>
    $('.transfer_div').hide();
    $('.loader').hide();
    $('.transfer_detail_div').hide()
    $('.form').hide()
    fetchCities()

    $('#suggested_price_for').change(function(){
        if($(this).val() == 'sightseeing'){
            $('.form').hide()
            $('.transfer_div').hide();
            $('.transfer_detail_div').hide()
            $('.city_div').show();
        }
        else{
            $('.form').hide()
            $('.city_div').hide()
            $('.transfer_div').show()
            $('.transfer_detail_div').show()
            getTransferType()
        }
    })

    $(document).on("change","#city",function()
    {
        if($("#city").val() != "")
        {
            var city_id = $(this).val();
            var country_id=$("#country").val();

            if (country_id != "") {
                if(city_id != "" ){
                    $(".loader").show();
                    $.ajax({
                        url:"{{url('/sightseeing_prices')}}",
                        type:"GET",
                        data:{"city_id":city_id,"country_id":country_id,
                                "src":"driver"},
                        success:function(response)
                        {
                            $("#menu_form").html(response);
                            $(".form").show();
                            $(".loader").hide();
                            visibility_type();
                        }
                        // error: function(response){
                        //     console.log(response);
                        // }
                    });
                }
            }
        }
    });
    $(document).on("change","#transfer_type_detail",function(){
        var transfer_from_to=$(this).val();
        var transfer_type=$("#transfer_type").val();
        var country_id=$("#country").val();
        $(".loader").show();
        $.ajax({
            url:"{{url('/transfer_prices')}}",
            type:"GET",
            data:{
                "transfer_type":transfer_type,
                "country_id":country_id,
                'transfer_from':transfer_from_to
                    },
            success:function(response)
            {
                $("#menu_form").html(response);
                $(".form").show();
                $(".loader").hide();
                visibility_type();
            }
        });
    })

    function visibility_type(){
        $("#loaderModal").modal("show");
        $('.type').each(function(){
            $(this).css('display','flex');
        });
        $('.scost').each(function(){
            $(this).removeAttr("readonly");
        });
        $('.cost').each(function(){
            $(this).css('display','none');
            $(this).prop("disabled",true);
        });
            $("#loaderModal").modal("hide");
    }

    $('#country').change(function(){
        fetchCities()
    })

    function fetchCities(){
        var country = $('#country').val();
        if($('#suggested_price_for').val() == 'sightseeing'){
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
                        html += `<option value = ${key} >${value}</option>`
                    })
                }
                else{
                    html = '<option disabled selected hidden>--No Avalaible City For This Country--</option>'
                }
                $('#city').html(html)
                }
            })
        }else{
            getTransferType()
        }
    }

    $(document).on("change","#transfer_type",function(){
        getTransferType()
    })

    function getTransferType(){
        if($("#transfer_type").val() != "")
        {
            var html = ''
            var transfer_type=$('#transfer_type').val();
            var country_id=$("#country").val();
            if (country_id != "" )
            {
                $(".loader").show()

                $.ajax({
                    url:"{{url('/tranfers')}}",
                    type:"GET",
                    data:{"transfer_type":transfer_type,
                            "country_id":country_id},
                    success:function(response)
                    {
                        if(Object.keys(response).length > 0){
                            if(transfer_type == 'from-airport'){
                            html ='<option disabled selected hidden>--Select Airport--</option>'
                            $("#transfer_type_detail_label").html('From Airport');
                            }
                            else if(transfer_type == 'from-border'){
                                html ='<option disabled selected hidden>--Select Border--</option>'
                                $("#transfer_type_detail_label").html('From Border');
                            }
                            else if(transfer_type == 'from-railway'){
                                html ='<option disabled selected hidden>--Select Railway--</option>'
                                $("#transfer_type_detail_label").html('From Railway');
                            }
                            else{
                                html ='<option disabled selected hidden>--Select City--</option>'
                                $("#transfer_type_detail_label").html('From City');
                            }
                            $.each(response,function(key, value){
                                html += `<option value = ${key} >${value}</option>`
                            })
                        }
                        else{
                            if(transfer_type == 'from-airport'){
                            html ='<option disabled selected hidden>--No Airport Available--</option>'
                            $("#transfer_type_detail_label").html('From Airport');
                            }
                            else if(transfer_type == 'from-border'){
                                html ='<option disabled selected hidden>--No Border Available--</option>'
                                $("#transfer_type_detail_label").html('From Border');
                            }
                            else if(transfer_type == 'from-railway'){
                                html ='<option disabled selected hidden>--No Railway Available--</option>'
                                $("#transfer_type_detail_label").html('From Railway');
                            }
                            else{
                                html ='<option disabled selected hidden>--No City Available--</option>'
                                $("#transfer_type_detail_label").html('From City');
                            }
                        }
                        $("#transfer_type_detail").html(html);
                        $(".transfer_detail_div").show();
                        $(".loader").hide();
                    }
                });

            }
        }
    }
</script>
@endpush
