@php
    $layout = 'layouts.main';
    $section = 'main';
    if(auth()->guard('supplier')->check()){
        $layout = 'supplier::layouts.master';
        $section = 'content';
    }
@endphp
@extends($layout)
@push('style')
    <style>
        .title{
            font-size: 1.3rem !important;
            font-weight: 600;
            line-height: 3rem;
            letter-spacing: 1px;
        }
        .desc{
            font-size: 1.1rem !important;
            line-height: 3rem;
            letter-spacing: 0.4px;
        }
        .blockquote{
            min-width: 20rem;
            background: aliceblue;
        }
        .scrollable{
            max-width: 35rem !important;
            max-height: 15rem;
            padding: 5px 10px;
            border: 1px solid rgb(0 0 0 / 8%);
            border-radius: 5px 5px;
            overflow-y: auto;
            box-shadow: 1px 1px 6px rgba(0,0,0,0.12);
        }

    </style>
@endpush
@php
    $bs_color = ['primary','secondary','success','info','warning','danger'];
@endphp
@section('title','View Activity')
@section($section)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                <h1 class="my-2 border-bottom">Basic</h1>
                <div class="row">
                    <div class="col-sm-2"><label class="title">Activity Name:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->name}}</label></div>
                    <div class="col-sm-2"><label class="title">Type:</label></div>
                    <div class="col-sm-4"><label class="desc">{{  $model->activityType->activity_type_name }}</label></div>
                    <div class="col-sm-2"><label class="title">Supplier:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ getSuppliers($model->supplier_id)->name }}</label></div>
                    <div class="col-sm-2"><label class="title">Location:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ $model->location }}</label></div>
                    <div class="col-sm-2"><label class="title">Country:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ countries($model->country_id)->country_name }}</label></div>
                    <div class="col-sm-2"><label class="title">City:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ getSelectedCity($model->city_id)->name }}</label></div>
                    <div class="col-sm-2"><label class="title">Duration:</label></div>
                    <div class="col-sm-4"><label class="desc"></label>{{ $model->duration }}</div>
                    <div class="col-sm-2"><label class="title">Validity</label></div>
                    <div class="col-sm-4"><label class="desc">from: {{ $model->valid_from }} To: {{ $model->valid_to }}</label></div>
                    <div class="col-sm-2"><label class="title">Availabel Time:</label></div>
                    <div class="col-sm-4"><label class="desc">from: {{ $model->time_from }} To: {{ $model->time_to }}</label></div>
                    <div class="col-sm-2"><label class="title">Currency</label></div>
                    <div class="col-sm-4"><label class="desc">{{ activeCurrencies($model->currency)->name }}</label></div>
                    <div class="col-sm-2"><label class="title">Availabel Days</label></div>
                    <div class="col-sm-10">
                        @foreach($model->activity_available_days as $day => $bool)
                            @if($bool == 'yes')
                                <label class="badge bg-{{ $bs_color[rand(0,5)] }} p-1"> {{$day}} </label>
                            @endif
                        @endforeach
                    </div>

                    <div class="col-sm-2"><label class="title">Blackout Days:</label></div>
                    <div class="col-sm-10">
                        @foreach (explode(',' , $model->blackout_days) as $key => $days)
                            <label class=" badge bg-{{ $bs_color[rand(0,5)] }} ">{{ $days }}</label>
                        @endforeach
                    </div>
                    <div class="col-sm-12"><label class="title">Allowed Age Groups & their Ages:</label></div>
                    <div class="col-sm-12">
                        <div class="row">
                        @foreach ($model->age_groups as $group => $attributes)
                            @if($attributes['allowed'] == 'Yes')
                                <div class="col-sm-3 ms-4 blockquote">
                                    <label class="title text-xl">{{ ucfirst($group) }}: </label><br>
                                    <label class="desc">Minimum Age: {{ $attributes['min_age'] }}</label><br>
                                    <label class="desc">Maximum Age: {{ $attributes['max_age'] }}</label><br>
                                </div>
                            @endif
                        @endforeach
                        </div>
                    </div>
                </div>
                <h1 class="my-2 border-bottom">Pricing</h1>
                <div class="row">
                        @foreach ($model->pricings as $key => $prices)
                            @if($prices->min_pax != null && $prices->max_pax != null)
                                <div class="col-sm-3 blockquote">
                                    <label class="title">{{ ucfirst($prices->pricing_for) }}:</label><br>
                                    <label class="desc">Minimum Pax: {{ $prices->min_pax }}</label><br>
                                    <label class="desc">Maximum Pax: {{ $prices->max_pax }}</label><br>
                                    <label class="desc">Price: {{ activeCurrencies($model->currency)->symbol.$prices->price }}</label><br>
                                </div>
                            @endif
                        @endforeach
                </div>
                <h1 class="my-2 border-bottom">Booking</h1>
                <div class="row">
                    @foreach ($model->booking as $key => $booking)
                        <div class="col-sm-4">
                            <label class="title">Session {{ $key+1 }}:</label><br>
                            <label class="desc ms-4">From: {{ $booking->from_date }} - To: {{ $booking->to_date }}</label><br>
                            <label class="title">Timings: </label><br>
                            @foreach ($booking->time_from as $index => $time)
                                <div class="blockquote">
                                    <label class="desc">From: {{ $time }}</label>
                                    <label class="desc">To: {{ $booking->time_to[$index] }}</label><br>
                                    <label class="desc">No. Of Persons: {{ $booking->no_of_pax[$index] }}</label><br>
                                    @if ($booking['surge'][$index] != null)
                                        <label class="desc">Surge: {{ $booking->surge[$index] }}%</label><br>
                                    @endif
                                    @if ($booking['discount'][$index] != null)
                                        <label class="desc">Discount: {{ $booking->discount[$index] }}%</label><br>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
                <h1 class="my-2 border-bottom">Descriptions</h1>
                <div class="row">
                    @if ($model->inclusions != null)
                        <div class="col-sm-6 ">
                            <label class="title">Inclusions</label>
                            <div class="scrollable">{!! $model->inclusions !!}</div>
                        </div>
                    @endif
                    @if ($model->exclusions != null)
                        <div class="col-sm-6 ">
                            <label class="title">Exclusions</label>
                            <div class="scrollable">{!! $model->exclusions !!}</div>
                        </div>
                    @endif
                    @if ($model->description != null)
                        <div class="col-sm-6 ">
                            <label class="title">Description</label>
                            <div class="scrollable">{!! $model->description !!}</div>
                        </div>
                    @endif
                    @if ($model->cancel_policy != null)
                        <div class="col-sm-6 ">
                            <label class="title">Cancellation Policy</label>
                            <div class="scrollable">{!! $model->cancel_policy !!}</div>
                        </div>
                    @endif
                    @if ($model->terms_conditions != null)
                        <div class="col-sm-6 ">
                            <label class="title">Terms & Conditions</label>
                            <div class="scrollable">{!! $model->terms_conditions !!}</div>
                        </div>
                    @endif
                    @if ($model->confirm_message != null)
                        <div class="col-sm-6 ">
                            <label class="title">Confirmation Message</label>
                            <div class="scrollable">{!! $model->confirm_message !!}</div>
                        </div>
                    @endif
                </div>
                <h1 class="my-2 border-bottom">Images</h1>
                <div class="row">
                    @foreach ($model->images as $key => $image)
                        <div class="col-sm-3">
                            <div class="card">
                                <img src="{{ $image->activity_image_url }}" alt="image-{{$key}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-footer">
                <a href="{{ url()->previous() }}" class="btn btn-success"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
            </div>
        </div>
    </div>
</div>
@endsection

