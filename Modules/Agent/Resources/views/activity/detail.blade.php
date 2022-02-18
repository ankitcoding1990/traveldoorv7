@extends('agent::layouts.master')

@section('title')
    Activity Details
@endsection

@section('content')
    <div class="box">
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-12" style="padding:0;overflow:hidden">
                                <div class="slider-box">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="box">
                                            <div class="">
                                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                                    class="swiper mySwiper2">
                                                    <div class="heading-name">
                                                        <p class="country_name ng-binding"> {{$activity->name}} </p>
                                                    </div>
                                                    <div class="swiper-wrapper">
                                                        @foreach ($activity->images as $image)
                                                            <div class="swiper-slide" data-swiper-autoplay="2000">
                                                                <a href="{{ $image->activity_image_url }}" data-fancybox="gallery1">
                                                                    <img src="{{ $image->activity_image_url }}" />
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <div class="swiper-button-next">
                                                        <div class="arrow-text1">Next</div>
                                                    </div>
                                                    <div class="swiper-button-prev">
                                                        <div class="arrow-text2">Previous</div>
                                                    </div>
                                                </div>
                                                <div thumbsSlider="" class="swiper mySwiper">
                                                    <div class="swiper-wrapper">
                                                        @foreach ($activity->images as $image)
                                                            <div class="swiper-slide">
                                                                <img src="{{ $image->activity_image_url }}" />
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-btn">
                                    <p class="hotel-type">{{ ucfirst($activity->activityType->activity_type_name) }}</p>
                                    <p class="hotel-type"><b>Duration : </b>Around {{ $activity->duration }}</p>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top:10px">
                                <p>{!! $activity->description !!}</p>
                            </div>
                            <div class="col-md-12" style="margin-top:20px">
                                <div class="box">
                                    <div class=" accor-div">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs customtab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active show" data-toggle="tab" href="#Inclusion" role="tab" aria-selected="true">
                                                    <span class="hidden-sm-up"><i class="ion-email"></i></span>
                                                    <span class="hidden-xs-down">Inclusions</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link show" data-toggle="tab" href="#Exclusion" role="tab" aria-selected="false">
                                                    <span class="hidden-sm-up"><i class="ion-home"></i></span>
                                                    <span class="hidden-xs-down">Exclusions</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link show" data-toggle="tab" href="#Cancellation" role="tab" aria-selected="false">
                                                    <span class="hidden-sm-up"><i class="ion-person"></i></span>
                                                    <span class="hidden-xs-down">Cancellation</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link show" data-toggle="tab" href="#tc" role="tab" aria-selected="false">
                                                    <span class="hidden-sm-up"><i class="ion-email"></i></span>
                                                    <span class="hidden-xs-down">T &amp; C</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content accord-content">
                                            <div class="tab-pane active show" id="Inclusion" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-content" style="margin-top:0">
                                                            <div id="navpills-1" class="tab-pane active">
                                                                <div class=" tab-pane animation-fade active" id="category-1"
                                                                    role="tabpanel">
                                                                    <button class="accordion"><span class="acc-title">Inclusions</span></button>
                                                                    <div class="p-2">
                                                                        <p>{!! $activity->inclusions !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane show" id="Exclusion" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-content" style="margin-top:0">
                                                            <div id="navpills-1" class="tab-pane active">
                                                                <div class=" tab-pane animation-fade active" id="category-1"
                                                                    role="tabpanel">
                                                                    <button class="accordion"><span
                                                                            class="acc-title">Exclusions</span></button>
                                                                    <div class="p-2">
                                                                        <p>{!! $activity->exclusions !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane show" id="Cancellation" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-content" style="margin-top:0">
                                                            <div id="navpills-1" class="tab-pane active">
                                                                <div class=" tab-pane animation-fade active" id="category-1"
                                                                    role="tabpanel">
                                                                    <button class="accordion"><span
                                                                            class="acc-title">Cancellation</span></button>
                                                                    <div class="p-2">
                                                                        <p>{!! $activity->cancel_policy !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane show" id="tc" role="tabpanel">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="tab-content" style="margin-top:0">
                                                            <div id="navpills-1" class="tab-pane active">
                                                                <!-- Categroy 1 -->
                                                                <div class=" tab-pane animation-fade active"
                                                                    id="category-1" role="tabpanel">
                                                                    <button class="accordion"><span
                                                                            class="acc-title">T
                                                                            & C</span></button>
                                                                    <div class="p-2">
                                                                        <p>{!! $activity->terms_conditions !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="price-b">
                                    <div class="a-price">
                                        <span id="total_price_text">{{ $activity->pricings[0]['price'] }} </span><span class=" ng-binding">GEL</span>
                                        <span class="info-s" title="The initial price based on 1 adult">i</span>
                                    </div>
                                </div>
                                <form id="" method="post" action="">
                                    <div class="book_card">
                                        <div class="booking_detail" style="padding:0 !important">
                                            <div class="">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <div class="col-md-7">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="select_date">SELECT DATE <span
                                                            class="asterisk">*</span></label>
                                                    <div class="input-group date">
                                                        <input type="text" placeholder="FROM" class="form-control validate pull-right datepicker-future" id="select_date" name="select_date">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="">
                                                <div class="form-group">
                                                    <label for="select_date">SELECT TIME SLOT <span
                                                            class="asterisk">*</span></label>
                                                    <div class="input-group">
                                                        <select name="select_time" id="select_time" class="form-control" required="required">
                                                            <option>--SELECT TIME SLOT--</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pricing-div my-1">
                                                <div class="col-sm-12">
                                                    <div class="row">
                                                        @foreach ($activity->age_groups as $key => $ages)
                                                            @if ($ages['allowed'] == 'Yes')
                                                                <div class="col-md-4">
                                                                    <label for="adult_count"><b>{{ ucfirst($key) }} <span class="asterisk">*</span></b><br>Age {{ $ages['min_age'] }} - {{ $ages['max_age'] }} </label>
                                                                </div>
                                                                <div class="col-md-8">
                                                                    <input type="text" class="form-control isNumeric" name="adult_count" id="adult_count" maxlength="3" placeholder="No. of {{ $key }}s">
                                                                </div>
                                                            @else
                                                                <div class="col-md-12 my-3">
                                                                    <b>{{ ucfirst($key) }}</b> are not allowed
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="hotel_detail">
                                                <p class="hotel_desc">Activity Description</p>
                                                <p class="para">
                                                    <b>Country : </b>{{ $activity->country->country_name }}
                                                </p>
                                                <p class="para">
                                                    <b>City : </b>{{ $activity->city->name }}</p>
                                                <p class="para"><b>Location : </b>{{ $activity->location }}</p>
                                            </div>
                                            <div class="book_btn">
                                                <button type="submit" id="activity_book_btn" class="btn btn-rounded btn-primary mx-auto">BOOK</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 10,
            slidesPerView: 8,
            freeMode: true,
            watchSlidesProgress: true,

        });
        var swiper2 = new Swiper(".mySwiper2", {
            spaceBetween: 10,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 5000,
            },
            thumbs: {
                swiper: swiper,
            },
        });

        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    </script>
@endpush
