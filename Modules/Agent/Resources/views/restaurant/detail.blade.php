@extends('agent::layouts.master')

@section('title')
Restaurant Details
@endsection

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        * {
            font-family: "Nunito Sans", sans-serif;
        }

        a {
            color: #5c6975;
        }

        body {
            overflow-x: hidden;
            overflow-y: auto;
            color: #5c6975;
            font-size: 1rem;
            font-style: normal;
            font-weight: 400;
            font-family: "Nunito Sans", sans-serif;
            line-height: 1.5;
            /* background-color: #fff; */
        }

        .box {
            position: relative;
            border-top: 0;
            margin-bottom: 30px;
            width: 100%;
            background-color: #ffffff;
            border-radius: 5px;
            padding: 0px;
            -webkit-transition: .5s;
            transition: .5s;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            box-shadow: 0 10px 15px -5px rgb(0 0 0 / 7%);
        }

        .box-body {
            padding: 1.5rem 1.5rem;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            border-radius: 5px;
        }

        /*-----Slider -----*/
        .swiper {
            width: 100%;
            height: 100%;
        }

        .swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .swiper {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
            height: 100px;
            width: 100%;
            float: left;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            padding: 0 5%;
            background: #000;
            object-fit: cover;
        }

        /**-------For disable slider dots-------*/
        .swiper-horizontal>.swiper-pagination-bullets,
        .swiper-pagination-bullets.swiper-pagination-horizontal,
        .swiper-pagination-custom,
        .swiper-pagination-fraction {
            display: none;
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            display: none;
        }

        /**-------For disable slider dots-------*/
        .arrow-text1,
        .arrow-text2 {
            position: absolute;
            font-size: 16px;
            font-weight: 600;
            color: #fff;
        }

        .arrow-text1 {
            right: 10px;
        }

        .arrow-text2 {
            left: 10px;
        }

        .arrow-text2::after {
            content: '\f053';
            font-family: 'Font Awesome 5 Pro';
            position: absolute;
            color: #fff;
            left: 0;
            bottom: 15px;
            font-size: 40px;
        }

        .arrow-text1::after {
            content: '\f054';
            font-family: 'Font Awesome 5 Pro';
            position: absolute;
            bottom: 15px;
            right: 0;
            font-size: 40px;
        }

        .hr-total {
            display: block;
            width: 94%;
            background: #eeeeee;
            margin: 10px auto;
            height: 1px;
            opacity: 0.4;
        }

        .Tab-para {
            font-size: 21px;
            display: flex;
            justify-content: flex-start;
            align-items: end;
            color: #5c6975;
            font-style: normal;
            font-weight: 400;
            float: left;
        }

        .trad {
            position: absolute;
            top: 0;
            right: 13px;
            background: #ffffff;
            color: #5cb660;
            border: 1px solid #5cb660;
            padding: 4px 10px;
            border-radius: 8px;
            min-width: 99px;
            width: auto;
            text-align: center;
        }

        p.address {
            margin-bottom: 25px;
        }

        .slider-img {
            max-width: 100%;
            height: 400px;
        }

        .star-p {
            font-size: 18px;
            color: #d23d64;
        }

        .star1 {
            color: white;
            background: orange;
            padding: 5px;
            border-radius: 50%;
        }

        .decription-section ul li {
            line-height: 24px;
        }

        .decription-section {
            margin-top: 19px;
            padding: 10px 20px;
        }

        .first ul {
            margin-top: 12px;
            color: #5c6975;
            font-style: normal;
            font-weight: 400;
        }

        .price-block {
            border: 3px dashed #F44336;
            padding: 10px 15px;
            text-align: center;
            margin-bottom: 20px;
        }

        .price-gel {
            color: #f44336;
            font-size: 15px;
            line-height: 1;
            font-weight: 600;
            text-align: right;
            position: relative;
        }

        .price-1 {
            font-size: 15px;
            color: #3F51B5;
        }

        .price-2 {
            font-size: 15px;
            color: #3F51B5;
        }

        .price-total {
            font-size: 20px;
            color: #000000;
        }

        .total-gel {
            color: #f44336;
            font-size: 23px;
            text-align: right;
            font-weight: 600;
            position: relative;
        }

        .form-group label {
            font-weight: 500;
            font-size: 12px;
        }

        span.asterisk {
            color: red !important;
        }

        #select_date {
            border-radius: 0;
            border-color: gainsboro;
            background: white;
        }

        .input-group-addon {
            border-color: #234076 !important;
            border-radius: 0 !important;
            background: #234076 !important;
            font-weight: 300;
            padding: .425rem .75rem;
            border: 1px solid #234076 !important;
            line-height: 1.25;
            color: #fff;
            text-align: center;
            margin-bottom: 0;
            font-size: 1rem;
        }

        .book-btn {
            background-color: #ec407a;
            border-color: #ec407a;
            color: #ffffff;
            border-radius: 60px;
            line-height: inherit;
            padding: 8px 16px;
            border: none;
        }

        .person {
            font-size: 15px;
        }

        .form1 {
            padding: 5px 5px;
        }

        .collapse-btn {
            width: 100%;
            text-align: left;
            border-radius: 0px;
            /* background: gray; */
            border: none;
            color: white;
            background: #ec407a;
            cursor: pointer;
            padding: 10px 10px;
            font-weight: 600;
        }

        .sight-seeing {
            padding: 10px 10px;
            margin-top: 16px;
            width: 100%;
        }

        .btn-heading {
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: 600;
        }

        .cat-text {
            color: #000;
            padding-right: 4px;
        }

        .break-text {
            color: #e53932;
        }

        .para-text {
            font-size: 14px;
            line-height: 20px;
            color: #888;
            ;
        }

        .rate {
            color: #e53932;
            font-size: 18px;
        }

        .col-div {
            padding: 20px 10px;
        }

        .book-card {
            background: #fefeff;
            box-shadow: 0 10px 15px -5px rgba(0, 0, 0, 0.07);
            margin-bottom: 50px;
            border-radius: 5px;
            width: 100%;
        }

        .row-border {
            border-color: gray;
            border-bottom: 1px dashed;
            padding: 14px 10px;
        }

        .fur-p {
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 16px;
            text-transform: uppercase;
            padding-bottom: 9px;
        }

        .right-class {
            position: absolute;
            right: 26px;
        }

        .fixed {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
        }

        button:focus {
            outline: 0px !important;
        }

        @media (min-width:250px) and (max-width:539px) {
            .Tab-para {
                font-size: 13px !important;
                float: none;
            }
            .trad{
                top: -7px;
            }
            .mySwiper{
                height: 60px
            }
            .arrow-text1::after,
            .arrow-text2::after {
                font-size: 25px;
            }
        }

        @media (min-width: 540px) and (max-width: 767px) {
            .Tab-para {
                font-size: 16px !important;
                float: none;
            }
            .trad{
                top: -7px;
            }
            .mySwiper{
                height: 60px
            }
            .arrow-text1::after,
            .arrow-text2::after {
                font-size: 25px;
            }

        }
    </style>
</head>

<body>
    <div class="box">
        <div class="box-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="Tab-para">{{$restaurant->name}}</p>
                                <p class="trad">{{$restaurant->getRestaurantType->restaurant_type_name}}</p>
                            </div>
                            <div class="col-md-4">
                                <p class="address">
                                    <i class="fa fa-map-marker"></i>
                                    {{$restaurant->address}}
                                </p>
                            </div>
                            <div class="col-md-4">
                                <i class="fa fa-clock"></i>
                                {{TwelveHourTime($restaurant->valid_from_time)}} - {{TwelveHourTime($restaurant->valid_to_time)}}
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-12" style="padding:0;overflow:hidden">
                                <div class="slider-box">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="box">
                                            <div class="">
                                                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                                                    class="swiper mySwiper2">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide" data-swiper-autoplay="2000">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery14-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide" data-swiper-autoplay="2000">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery15-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide" data-swiper-autoplay="2000">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery30-1.jpg" />
                                                        </div>
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
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery14-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery15-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery30-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery37-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery8-1.jpg" />
                                                        </div>
                                                        <div class="swiper-slide">
                                                            <img
                                                                src="https://crm.traveldoor.ge/assets/uploads/restaurant_images/restaurant-1622808573-JimmyJimmy-Restaurant-Tbilisi-Georgia-Gallery6-1.jpg" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <section class="decription-section">
                                        <p class="star-p">
                                            <i class="fa fa-star star1"></i>&nbsp;Restaurant Description
                                        </p>
                                        
                                        <p>{!!$restaurant->description!!}</p>
                                    </section>
                                </div>
                            </div>
                            <hr style="border-color: #ffc0c0;width: 100%;">
                            <div class="sight-seeing">
                                <p class="star-p">
                                    <i class="fa fa-star star1"></i>&nbsp;Restaurant Menu
                                </p>
                                <div class="row">
                                    <div class="col-md-12 mt-1">
                                        <button type="button" class="collapse-btn" data-toggle="collapse"
                                            data-target="#soups_3">Soups<span class="right-class"><i class="fa fa-plus"
                                                    aria-hidden="true"></i></span></button>
                                        <div id="soups_3" class="collapse col-div">
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">TOMATO CORIANDER SHORBA</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Soups</span>
                                                    <p class="para-text"><b>Ingredients : </b>Tomato Soup Blended with
                                                        Fresh Coriander Leaves</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 13</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[0]"
                                                            id="food_qty__0">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">

                                                <div class="col-md-10">

                                                    <p class="btn-heading">PAYA SHORBA</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Soups</span>
                                                    <p class="para-text"><b>Ingredients : </b>Lamb Soup Infused with
                                                        Cardamom, Saffron and Minced Lamb Quenelles</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 15</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[1]"
                                                            id="food_qty__1">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">CHICKEN SHORBA</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Soups</span>
                                                    <p class="para-text"><b>Ingredients : </b>Chicken Clear Soup
                                                        Flavored with Ginger and Indian herbs.</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 15</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[2]"
                                                            id="food_qty__2">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <button type="button" class="collapse-btn" data-toggle="collapse"
                                            data-target="#salads_6">Salads<span class="right-class"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></span></button>
                                        <div id="salads_6" class="collapse col-div">
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">FATTOUSH SALAD</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Salads</span>
                                                    <p class="para-text"><b>Ingredients : </b>Middle Eastern salad with
                                                        an Indian inspired vinaigree dressing and chapa croutons.</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 22</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[3]"
                                                            id="food_qty__3">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">CHICKEN CAESAR SALAD</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Salads</span>
                                                    <p class="para-text"><b>Ingredients : </b>We transform classic
                                                        Italian salad, the secret is in the lime, garlic and yoghurt
                                                        dressing.</p>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="rate">GEL 26</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[4]"
                                                            id="food_qty__4">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">GARDEN SALAD</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Salads</span>
                                                    <p class="para-text"><b>Ingredients : </b>Mixed leuce, cucumber and
                                                        cherry tomato with mint vinaigree dressing.</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p class="rate">GEL 20</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[5]"
                                                            id="food_qty__5">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <button type="button" class="collapse-btn" data-toggle="collapse"
                                            data-target="#starters_veg_15">Starters Veg<span class="right-class"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></span></button>
                                        <div id="starters_veg_15" class="collapse col-div">
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">PANEER (COTTAGE CHEESE) MALAI TIKKA</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Rich mouth melng paneer
                                                        kka with cream and cheese</p>
                                                </div>
                                                <div class="col-md-2">
                                                    <p class="rate">GEL 29</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[6]"
                                                            id="food_qty__6">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">TANDOORI MUSHROOMS</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Marinated mushrooms in
                                                        yogurt &amp; Indian herbs– skewered &amp; grilled in Tandoor</p>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="rate">GEL 29</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[7]"
                                                            id="food_qty__7">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">STUFFED POTATO - BHARWAAN ALOO</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Potatoes Stuffed with
                                                        Herbs, Spices, Sultanas and Cashew Nuts, Cooked in Tandoor</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 22</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[8]"
                                                            id="food_qty__8">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">

                                                <div class="col-md-10">

                                                    <p class="btn-heading">TANDOORI BROCCOLI</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Florets of Broccoli
                                                        marinated with cashew nuts and cheese, chargrilled in Tandoor
                                                    </p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 24</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[9]"
                                                            id="food_qty__9">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">SWEET CORN KEBAB - BHUTTEY KE KEBAB</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Poached American Corn
                                                        Blended with Herbs, Cheddar Cheese and Pan Grilled</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 26</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[10]"
                                                            id="food_qty__10">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / 1
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <button type="button" class="collapse-btn" data-toggle="collapse"
                                            data-target="#starters_n-veg_16">Starters N-Veg<span class="right-class"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></span></button>
                                        <div id="starters_n-veg_16" class="collapse col-div">
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">TANDOORI PRAWNS</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters N-Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>King Prawns marinated in
                                                        special Indian spices &amp; yogurt, then chargrilled in tandoor
                                                    </p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 39</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[11]"
                                                            id="food_qty__11">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">FRIED PRAWNS</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters N-Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Crispy fried King Prawns
                                                        served with sweet chili sauce.</p>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="rate">GEL 39</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[12]"
                                                            id="food_qty__12">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">FISH FRY</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters N-Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>CHOOSE YOUR FISH: RAINBOW
                                                        TROUT/ SEA-BASS/ SEA-BREAM A whole fish marinated in Indian
                                                        spices and deep fried</p>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="rate">GEL 31</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[13]"
                                                            id="food_qty__13">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select> / -
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-10">
                                                    <p class="btn-heading">FISH TIKKA</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Starters N-Veg</span>
                                                    <p class="para-text"><b>Ingredients : </b>Chunks of Hammour
                                                        marinated in mild mustard &amp; finished in tandoor</p>
                                                </div>

                                                <div class="col-md-2">

                                                    <p class="rate">GEL 33</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[14]"
                                                            id="food_qty__14">
                                                            <option value="0">Quantity</option>
                                                            <option value="1">1</option>
                                                        </select> 
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-12 mt-1">
                                        <button type="button" class="collapse-btn" data-toggle="collapse"
                                            data-target="#set_menu_44">Set Menu<span class="right-class"><i
                                                    class="fa fa-plus" aria-hidden="true"></i></span></button>
                                        <div id="set_menu_44" class="collapse col-div">
                                            <div class="row row-border">
                                                <div class="col-md-3">
                                                    <img
                                                        src="https://crm.traveldoor.ge/assets/uploads/food_images/food-1625509283-shutterstock_1435374326 (1).jpg">
                                                </div>
                                                <div class="col-md-7">
                                                    <p class="btn-heading">Non Vegetarian Set (Halal- booking can be
                                                        done minimum 2 pax)</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Set Menu</span>
                                                    <p class="para-text"><b>Ingredients : </b>1.Butter Chicken 2.Mix Veg
                                                        3.Yellow Daal 4.Steamed Rice 5. Roti</p>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="rate">GEL 39</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[15]"
                                                            id="food_qty__15">
                                                            <option value="0">Quantity</option>
                                                            <option value="1">1</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-border">
                                                <div class="col-md-3">
                                                    <img
                                                        src="https://crm.traveldoor.ge/assets/uploads/food_images/food-1625509428-image.jpg">
                                                </div>
                                                <div class="col-md-7">
                                                    <p class="btn-heading">Vegetarian Set (Halal - minimum pax per
                                                        bookin-2)</p>
                                                    <span class="cat-text">Category:</span>&nbsp;<span
                                                        class="break-text">Set Menu</span>
                                                    <p class="para-text"><b>Ingredients : </b>1.Paneer tikka masala
                                                        2.Jerra aloo 3. Yellow daal 4.Steamed rice 5.Roti</p>
                                                </div>

                                                <div class="col-md-2">
                                                    <p class="rate">GEL 39</p>
                                                    <div class="form-group">
                                                        <select class="form-control food_qty" name="food_qty[16]"
                                                            id="food_qty__16">
                                                            <option value="0">Quantity</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-12">
                        <div class="sticky-top sticky-sidebar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="price-block">
                                        <div class="row">
                                            <div class="col-12">
                                                <div id="food_select_info">
                                                </div>
                                                <hr class="hr-total">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <p class="price-total">Total Price</p>
                                                    </div>
                                                    <div class="col-6">
                                                        <p class="total-gel">
                                                            GEL 0
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="book-card">
                                        <div class="form-group form1">
                                            <label for="select_date">SELECT DATE <span class="asterisk">*</span></label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" placeholder="DATE"
                                                    class="form-control pull-right datepicker" id="select_date"
                                                    name="select_date" required="required" value="2022-02-08">
                                            </div>
                                        </div>
                                        <div class="form-group form1">
                                            <label for="select_date">SELECT TIME<span class="asterisk">*</span></label>
                                            <div class="input-group date clockpicker">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-clock"></i>
                                                </div>
                                                <input type="text" placeholder="TIME"
                                                    class="form-control pull-right clockpicker" id="select_time"
                                                    name="select_time" required="required" value="11:40AM">

                                            </div>
                                        </div>

                                        <div class="form-group form1">
                                            <label for="person">NO. OF PERSONS<span class="asterisk">*</span></label>
                                            <div class="input-group ">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <select class="form-control" name="no_of_persons" required="required">
                                                    <option value="" selected="selected" hidden="">SELECT
                                                        PERSONS
                                                    </option>
                                                    <option value="1">1</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                                        <div class="book-btn-div">
                                            <button type="submit" class="book-btn">BOOK</button>
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

    <!-- Swiper JS -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 6,
            slidesPerView: 5,
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
    </script>
    <script>
        //Accordion
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

</body>

</html>
@endsection