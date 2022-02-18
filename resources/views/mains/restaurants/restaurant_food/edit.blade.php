@extends('layouts.main')
@section('main')
@if(true)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Edit Food / Drinks</h4>
            </div>
            <div class="box-body">
                {!! Form::model($foods,['class' => 'package_form' , 'method' => 'put','enctype' =>'multipart/form-data', 'route' =>['restaurant-foods.update',$foods->restaurant_food_id ]]) !!}
                @include('mains.restaurants.restaurant_food._form')
                <div class="row mb-10">
                    <div class="col-md-12">
                        <div class="box-header with-border" style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                            <button type="submit" id="update_food" class="btn btn-rounded btn-primary mr-10">Update</button>
                            <button type="button" id="discard_food" class="btn btn-rounded btn-primary">Discard</button>
                        </div>
                    </div>
                </div>
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
<script>
$(document).ready(function(){
    $(document).on("click", "#discard_food", function() {
        window.location.href = '/food-management';
    });

    $(document).on('input','#food_price,#food_discounted_price,#food_package_count', function (event) {
        this.value = this.value.replace(/[^0-9]+/g, '');
    });

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

            $(document).on("click", ".remove_already_images", function() {
            var image = this.id;
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this image !",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function(isConfirm) {
                if (isConfirm) {
                    $("#" + image).parent().remove();
                    swal("Deleted!", "Selected image has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your image is safe :)", "error");
                }
            });
        });
})
    </script>
@endpush
