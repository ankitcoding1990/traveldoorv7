@extends('layouts.main')
@section('main')
@php
    $rights = rights();
@endphp
@if($rights['add']==1)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Create Food / Drinks</h4>
            </div>
            <div class="box-body">
                {!! Form::open(['id' => 'restaurant_form','method' => 'post']) !!}
                @include('mains.restaurants.restaurant_food._form')
                <div class="row mb-10">
                    <div class="col-md-12">
                        <div class="box-header with-border" style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                            <button type="button" id="save_food" class="btn btn-rounded btn-primary mr-10">Save</button>
                            <button type="button" id="discard_food" class="btn btn-rounded btn-primary">Discard</button>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
@else
<h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection
@push('styles')
<style>
    header.main-header {
        background: url("{{ asset('assets/images/color-plate/theme-purple.jpg') }}");
    }

    .iti-flag {
        width: 20px;
        height: 15px;
        box-shadow: 0px 0px 1px 0px #888;
        background-image: url("flags.png") !important;
        background-repeat: no-repeat;
        background-color: #DBDBDB;
        background-position: 20px 0
    }

    div#cke_1_contents {
        height: 250px !important;
    }

    table#calendar-demo {
        width: 100%;
        height: 275px !important;
        min-height: 275px !important;
        overflow: hidden;
    }

    .calendar-wrapper.load {
        width: 100%;
        height: 276px;
    }

    .calendar-date-holder .calendar-dates .date.month a {
        display: block;
        padding: 17px 0 !important;
    }

    .calendar-date-holder {
        width: 100% !important;
    }

    section.calendar-head-card {
        display: none;
    }

    .calendar-container {
        border: 1px solid #cccccc;
        height: 276px !important;
    }

    img.plus-icon {
        margin: 0 2px;
        display: inline !important;
    }

    @media screen and (max-width:400px) {
        .calendar-date-holder .calendar-dates .date a {
            text-decoration: none;
            display: block;
            color: inherit;
            padding: 3px !important;
            margin: 1px;
            outline: none;
            border: 2px solid transparent;
            transition: all .3s;
            -o-transition: all .3s;
            -moz-transition: all .3s;
            -webkit-transition: all .3s;
        }
    }

    div#loaderModal .modal-content {
        background: transparent;
        box-shadow: none;
    }

    div#loaderModal .modal-dialog {
        margin-top: 17%;
    }

    div#loaderModal {
        background: #0000005c;
    }

    img.loader-img {
        display: block;
        margin: auto;
        width: auto;
        height: 50px;
    }
</style>
@endpush

@push('scripts')
@if (session()->has('status'))
    <script>
    swal('{{session('status')['title']}}','{{session('status')['message']}}','{{session('status')['type']}}');
</script>
@endif
<script>


$(document).ready(function(){
    function isNumberKey(evt)
                    {
                        var charCode = (evt.which) ? evt.which : event.keyCode
                        if (charCode > 31 && (charCode < 48 || charCode > 57))
                        return false;
                        return true;
                    }
    $(document).on("click", "#discard_food", function() {
    window.history.back();
    });

    $(document).on("click","#save_food",function(){
            var restaurant = $("#restaurant").val();
            var menu_category = $("#menu_category").val();
            var food_name = $("#food_name").val();
            var food_price = $("#food_price").val();
            var food_unit = $("#food_unit").val();
            // var food_package_count = $("#food_package_count").val();
            // var validity_operation_from = $("#validity_operation_from").val();
            // var validity_operation_to = $("#validity_operation_to").val();
            // var food_description = CKEDITOR.instances.food_description.getData();

        if(restaurant.trim() == "" || restaurant.trim() == "0") {
            $('#restaurant').css('border','1px solid #cf3c63')
            // $("#restaurant").parent().find(".select2-selection").css('border', '1px solid #cf3c63');

        } else

        {
            $('#restaurant').css('border','1px solid #9e9e9e')
        }
        if (menu_category.trim() == "0" || menu_category.trim() == "") {
            $("#menu_category").css("border", "1px solid #cf3c63");

        } else

        {
            $("#menu_category").css("border", "1px solid #9e9e9e");
        }

        if (food_name.trim() == "") {
            $("#food_name").css("border", "1px solid #cf3c63");

        } else

        {
            $("#food_name").css("border", "1px solid #9e9e9e");
        }

        if (food_price.trim() == "") {
            $("#food_price").css("border", "1px solid #cf3c63");

        } else

        {
            $("#food_price").css("border", "1px solid #9e9e9e");
        }

        if (food_unit.trim() == "") {
            $("#food_unit").css("border", "1px solid #cf3c63");

        } else

        {
            $("#food_unit").css("border", "1px solid #9e9e9e");
        }

        if (restaurant.trim() == "0") {
            $("#restaurant").parent().find(".select2-selection").focus()
            } else if (menu_category.trim() == "0") {
                $("#menu_category").parent().find(".select2-selection").focus()
            } else if (food_name.trim() == "") {
                $("#food_name").focus();
            } else if (food_price.trim() == "") {
                $("#food_price").focus();
            } else if (food_unit.trim() == "") {
                $("#food_unit").focus();
            // } else if (food_package_count.trim() == "") {
            //     $("#food_package_count").focus();
            }
            else{
                // alert("here")
                $("#save_restaurant").prop("disabled", true);
                $("#loaderModal").modal("show");
                var formdata = new FormData($("#restaurant_form")[0]);
                // console.log(formdata);
                formdata.append("food_description", food_description);
                $.ajax({
                    url: '{{route('restaurant-foods.store')}}',
                    enctype: "multipart/form-data",
                    type: "POST",
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == 'exists'){
                    swal({
                            title: response.title,
                            text: response.message,
                            type: response.type
                        })
                }else if(response.status == true){
                    swal({
                            title: response.title,
                            text: response.message,
                            type: response.type
                        },
                        function() {
                            window.location.href = '/food-management';
                            // location.reload();
                        })
                }else{
                    swal({
                            title: response.title,
                            text: response.message,
                            type: response.type
                    })
                }
                    }
                });
            }
        })
        // })
    $(document).on('input','#food_price,#food_discounted_price,#food_package_count', function (event) {
        this.value = this.value.replace(/[^0-9]+/g, '');
        });

    $(document).on("change", "#menu_category", function(){
        food_menu_id = $(this).val();
        if(food_menu_id == "44"){
        $("#food_drinks_ingredient").html("ITEMS INCLUDED");
    }
    else{
        $("#food_drinks_ingredient").html("FOOD / DRINKS INGREDIENTS ( , )");
    }
    })
    $(document).on("change", ".upload_ativity_images", function() {
            var imageSize = this;
            var count = 0;
            for (var i = 0; i < imageSize.files.length; i++) {
                var image_Size = imageSize.files[i].size;
                if (image_Size > 250000) {
                    alert("Try to upload files less than 250KB!");
                    $(this).val("");
                    break;
                    count++;
                }
            }
        });

        $(document).on("click", ".add_more_food_image", function() {
                var id = $(this).parent().parent().attr("id");
                var actual_id = id.split("increment");

                if (actual_id[1] == "") {
                    var html = $("#clone").html();
                    $("#increment").after(html);
                } else {
                    var html = $("#clone" + actual_id[1]).html();
                    $("#" + id).after(html);

                }

            });
            $("body").on("click", ".remove_more_food_image", function() {
                $(this).parents(".control-group").remove();
            });
})
</script>
@endpush
