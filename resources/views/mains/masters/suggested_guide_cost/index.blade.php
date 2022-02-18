@extends('layouts.main')
@push('style')
<style>
    .iti-flag {
    width: 20px;
    height: 15px;
    box-shadow: 0px 0px 1px 0px #888;
    background-image: url("{{asset('assets/images/flags.png')}}") !important;
    background-repeat: no-repeat;
    background-color: #DBDBDB;
    background-position: 20px 0
    }
    div#cke_1_contents {
    height: 250px !important;
    }
    .actions{
        margin: 0px 5px;
    }
    th[title=Action]{
        width: 190PX !important;
    }
    </style>
@endpush
@section('title','Suggested Guide Price')
@section('main')


@if(auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Guide Price</h4>
            </div>
            <div class="box-body">
                <form id="suggested_cost_form" enctype="multipart/form-data" onsubmit="ajaxFormSubmit($(this)); hideForm()" action="{{route('suggested_cost_guide.store')}}" method="POST" >
                    {{csrf_field()}}
                    <div class="row mb-10">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>COUNTRY <span class="asterisk">*</span></label>
                                        <select class="form-control select2" name="guide_country"
                                            id="guide_country" style="width: 100%;">
                                            <option selected="selected" hidden value="0">SELECT
                                            COUNTRY</option>
                                            @foreach($countries as $countries)
                                            <option value="{{$countries->id}}">{{$countries->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                        </div>
                    </div>
                    <div class="row mb-10" id="city_div" style="display:none;">
                        <div class="col-sm-12 col-md-12 col-lg-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="guide_city">CITY <span class="asterisk">*</span></label>
                                        <select id="guide_city" name="guide_city" class="form-control select2" style="width: 100%;">
                                            <option selected="selected">SELECT CITY</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6">
                        </div>
                    </div>
                    <div style="display:none;">
                        <h4>Sightseeing Tours</h4>
                        <div class="row mb-100" id="tour_div" style="border: 1px solid #ede9e9; padding: 20px;">
                        </div>
                    </div>
                    <div style="display:none;">
                        <h4>Airport Transfers</h4>
                        <div class="row mb-10" id="airport_div" style="border: 1px solid #ede9e9; padding: 20px;">
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <div class="box-header with-border"
                                style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                                <button type="submit" id="create_guide"
                                class="btn btn-rounded btn-primary mr-10">Save</button>
                                <button type="button" id="discard_guide"
                                class="btn btn-rounded btn-primary">Discard</button>
                            </div>
                        </div>
                    </div>
                </form>
                <center><img class="loader" src="\assets\images\loader.gif" style="width:40%; display:none"/></center>
            </div>
        </div>
    </div>
</div>
@endif

@endsection

@push('scripts')
<script>

function hideForm(){
    $("#tour_div").parent('div').hide();
    $("#airport_div").parent('div').hide();
}

$(document).on("change","#guide_country",function()
{
    if($(this).val()!="")
    {
        $('.loader').show();
        var country_id=$(this).val();
        $.ajax({
            url:'{{url("/get-cities")}}',
            dataType: 'JSON',
            method: 'get',
            data: {'country': country_id},
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
                $('#guide_city').html(html)
                $('#guide_city').select2();
                $('#city_div').show();
                $('.loader').hide();
            }
        })
    }
});
$(document).on("change","#guide_city",function()
{
    $('.loader').show();
    $("#airport_div").html('');

    if($("#guide_city").val()!="0")
    {

        var city_id=$(this).val();

        var country_id=$("#guide_country").val();

        $.ajax({

            url:"{{route('search_sight_seeing_Tour_airport')}}",
            type:"GET",
            data:{"city_id":city_id,"country_id":country_id,"src":"guide"},
            success:function(response)
            {
                $("#tour_div").html(response.sightseeing_html);
                $("#tour_div").parent('div').show();
                $("#airport_div").html(response.airport_html);
                $("#airport_div").parent('div').show();
                show_sightseeing('searchAirportsCost');
            }
        });
    }
});

function show_sightseeing(routeajax){
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

    if(routeajax == "searchAirportsCost"){
        $('.loader').hide();
    }
}
</script>
@endpush
