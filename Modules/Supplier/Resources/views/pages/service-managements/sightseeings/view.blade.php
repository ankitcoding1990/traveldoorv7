@extends('supplier::layouts.master')
@push('style')
    <style>
        .title {
            font-size: 1.3rem !important;
            font-weight: 600;
            line-height: 3rem;
            letter-spacing: 1px;
        }

        .desc {
            font-size: 1.1rem !important;
            line-height: 3rem;
            letter-spacing: 0.4px;
        }

        .blockquote {
            min-width: 20rem;
            background: aliceblue;
        }

        .scrollable {
            max-width: 35rem !important;
            max-height: 15rem;
            padding: 5px 10px;
            border: 1px solid rgb(0 0 0 / 8%);
            border-radius: 5px 5px;
            overflow-y: auto;
            box-shadow: 1px 1px 6px rgba(0, 0, 0, 0.12);
        }

    </style>
@endpush
@php
$bs_color = ['primary', 'secondary', 'success', 'info', 'warning', 'danger'];
@endphp
@section('title', 'View Sightseeing Services')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_tour_name"><strong>TOUR NAME :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_tour_name"> @if ($model->tour_name != '' && $model->tour_name != '0' && $model->tour_name != null){{ $model->tour_name }} @else No Data Available @endif </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_city_covered"><strong>CITIES COVERED:</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_city_covered"> @if ($model->city_covered != '' && $model->city_covered != '0' && $model->city_covered != null){{ $model->city_covered }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="users_lname"><strong>COUNTRY :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="users_lname"> @if ($model->country_id != '' && $model->country_id != '0' && $model->country_id != null) {{ $model->getCountry->country_name }}@else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_city_from"><strong>FROM CITY:</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_city_from"> @if ($model->from_city_id != '' && $model->from_city_id != '0' && $model->from_city_id != null){{ $model->getFromCity->name }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_city_between"><strong>IN BETWEEN CITIES:</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_city_between">
                                @if ($model->city_between_ids != '' && $model->city_between_ids != '0' && $model->city_between_ids != null)
                                    @foreach ($model->betweenCities() as $key => $cities)
                                    {{-- @dd($cities->name); --}}
                                       <span class="badge bg-{{ $bs_color[rand(0, 5)] }} px-1">{{ $cities->name }}</span>  @endforeach
                                    @else No Data Available @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_city_to"><strong>TO CITY:</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_city_to">
                                @if ($model->to_city_id != '' && $model->to_city_id != '0' && $model->to_city_id != null)
                                    {{ $model->getToCity->name }}

                                @else No Data Available @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_distance_covered"><strong>DISTANCE COVERED :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_distance_covered"> @if ($model->distance_covered != '' && $model->distance_covered != '0' && $model->distance_covered != null){{ $model->distance_covered }} KMS @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_duration"><strong>DURATION :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_duration"> @if ($model->duration != '' && $model->duration != '0' && $model->duration != null){{ $model->duration }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_fuel_type"><strong>FUEL TYPE :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_fuel_type">
                                @if ($model->fuel_type_id != '' && $model->fuel_type_id != '0' && $model->fuel_type_id != null)
                                    {{ $model->getFuelType->fuel_type }}

                                @else No Data Available @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_food_cost"><strong>FOOD COST :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_food_cost"> @if ($model->food_cost != '' && $model->food_cost != '0' && $model->food_cost != null){{ $model->food_cost }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_hotel_cost"><strong>HOTEL COST :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_hotel_cost"> @if ($model->hotel_cost != '' && $model->hotel_cost != '0' && $model->hotel_cost != null){{ $model->hotel_cost }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_total_expense_cost"><strong>TOUR EXPENSE WITHOUT ENTRANCE
                                    :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_total_expense_cost"> @if (!empty($model->food_cost) || !empty($model->hotel_cost)){{ $model->food_cost + $model->hotel_cost }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_adult_cost"><strong>ENTRANCE FEES FOR 1 ADULT :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_adult_cost"> @if ($model->adult_cost != '' && $model->adult_cost != '0' && $model->adult_cost != null){{ $model->adult_cost }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="sightseeing_child_cost"><strong>ENTRANCE FEES FOR 1 CHILD :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="sightseeing_child_cost"> @if ($model->child_cost != '' && $model->child_cost != '0' && $model->child_cost != null){{ $model->child_cost }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 blockquote">

                            <label for="discount"><strong>Discount\Surge :</strong></label>
                            <p class="" id="discount"> @if ($model->from_date)<span class="badge badge-light">{{ $model->from_date }}</span> To <span class="badge badge-light">{{ $model->to_date }}</span> @else No Data Available @endif  </p>
                            <p class="" id="discount"> No. of Person:  @if ($model->no_of_pax){{ $model->no_of_pax }} @else No Data Available @endif  </p>
                            <p class="" id="discount"> Surge:  @if ($model->surge){{ $model->surge }}% @else No Data Available @endif  </p>
                            <p class="" id="discount"> Discount:  @if ($model->discount){{ $model->discount }}% @else No Data Available @endif  </p>
                          
                           
                        </div>
                    </div>
                    <fieldset class="border p-2" style="border: 1px solid #c3c1c1 !important;margin:20px 0px 20px 0px">
                        <legend class="w-auto">Group Tour Price</legend>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sightseeing_group_adult_cost"><strong>PRICE FOR 1 ADULT :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="sightseeing_group_adult_cost"> @if ($model->group_adult_cost != '' && $model->group_adult_cost != '0' && $model->group_adult_cost != null){{ $model->group_adult_cost }} @else No Data Available @endif </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="sightseeing_group_child_cost"><strong>PRICE FOR 1 CHILD :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="sightseeing_group_child_cost"> @if ($model->group_child_cost != '' && $model->group_child_cost != '0' && $model->group_child_cost != null){{ $model->group_child_cost }} @else No Data Available @endif </p>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-12">
                                <label for="sightseeing_group_child_cost"><strong>GROUP TOUR TERMS &
                                        CONDITIONS</strong></label>
                                <p class="" id="sightseeing_group_child_cost"> @if ($model->group_tour_terms != '' && $model->group_tour_terms != '0' && $model->group_tour_terms != null){!! html_entity_decode($model->group_tour_terms) !!} @else No Data Available @endif </p>
                            </div>
                        </div>
                    </fieldset>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="users_status"><strong>STATUS :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="users_status">
                                @if ($model->status == '1')
                                    Active
                                @else
                                    InActive
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="users_contact"><strong>Created DateTime :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="users_contact"> @if ($model->created_at != '' && $model->created_at != null){{ $model->created_at }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="users_contact"><strong>Updated DateTime :</strong></label>
                        </div>
                        <div class="col-md-9">
                            <p class="" id="users_contact"> @if ($model->updated_at != '' && $model->updated_at != null){{ $model->updated_at }} @else No Data Available @endif </p>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <h4 class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">
                                <i class="fa fa-minus-circle" id="sightseeing_attractions"></i> TOUR DESCRIPTION
                            </h4>
                        </div>
                    </div>
                    <div class="row" id="sightseeing_attractions_details">
                        <div class="col-md-12">
                            <p class="" id="sightseeing_tour_desc">
                                @if ($model->tour_desc != '' && $model->tour_desc != '0' && $model->tour_desc != null)
                                {!! html_entity_decode($model->tour_desc) !!} @else No Data Available @endif
                            </p>

                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <h4 class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">
                                <i class="fa fa-minus-circle" id="sightseeing_attractions"></i> TOUR ATTRACTIONS
                            </h4>
                        </div>
                    </div>
                    <div class="row" id="sightseeing_attractions_details">
                        <div class="col-md-12">
                            <p>
                                @if ($model->attractions != '' && $model->attractions != null) {!! html_entity_decode($model->attractions) !!} @else No Data Available @endif
                            </p>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-md-12">
                            <h4 class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">
                                <i class="fa fa-minus-circle" id="sightseeing_images"></i> SIGHTSEEING IMAGES
                            </h4>
                        </div>
                    </div>
                    <div class="row" id="sightseeing_images_details">
                        @foreach ($model->images as $key => $image)
                            <div class="col-sm-3">
                                <div class="card">
                                    <img src="{{ $image->sightseeing_image_url }}" alt="image-{{ $key }}">
                                </div>
                            </div>
                        @endforeach

                    </div>
                    <br>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <div class="box-header with-border"
                                style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                                <button type="button" id="back_btn" onclick="window.history.back()"
                                    class="btn btn-rounded btn-primary mr-10">Back</button>
                                {{-- <a href="{{route('edit-sightseeing',['sightseeing_id'=>$model->id])}}"><button type="button" id="discard_sightseeing" class="btn btn-rounded btn-primary">Edit</button></a> --}}
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection
