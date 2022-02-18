@extends('layouts.main')
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

        .fa-star {
            font-size: 1.7rem;
            line-height: 3.3rem;
        }

        .checked {
            color: #ffc700;
        }

        .superlist {
            padding: 0px 55px;
        }

        .superitem {
            font-family: monospace;
            font-size: large;
            font-style: italic;
        }

        .card-text {
            font-size: 0.9rem;
            font-style: oblique;
            font-family: revert;
            letter-spacing: 0.5px;
            color: #b1b2bd;
        }

        .card-title {
            font-size: 1.2rem;
            font-family: system-ui;
            font-weight: 600;
        }
        .parent-list{
            margin: 0;
            list-style: none;
            padding: 0;
        }
        .sub-list{
            padding: 7px 20px;
            background: aliceblue;
            display: inline-block;
            box-shadow: 2px 1px 4px 0px #00000038;
            margin-top: 8px;
            word-break: break-word;
        }
        .truncate{
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .paragraph p{
            font-size: 1rem;
            font-family: system-ui;
            color: #acacaf;
        }
    </style>
@endpush
@section('title', 'View Hotel')
@section('main')
    <div class="row py-3">
        <div class="col-12">
            <div class="box py-4">
                <div class="box-body">
                    <h3 class="border-bottom">Basic</h3>
                    <div class="row py-3">
                        <div class="col-sm-3">
                            <p class="title">Name:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ ucfirst($hotel->hotel_name) }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Supplier:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ ucfirst($hotel->supplier->name) }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Hotel Type:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ ucfirst($hotel->hotelType->hotel_type_name) }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Location:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ $hotel->location }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Country:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ $hotel->getCountry->country_name }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">City:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ $hotel->city->name }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Contacts:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ $hotel->hotel_contact }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Currency Accepted:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">{{ $hotel->currency->full_name }}</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Ratings:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $hotel->hotel_rating)
                                        <i class="fa fa-star checked" aria-hidden="true"></i>
                                    @else
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    @endif
                                @endfor
                            </p>
                        </div>
                        <div class="col-sm-3">
                            <p class="title">Booking Availability:</p>
                        </div>
                        <div class="col-sm-3">
                            <p class="desc">From:{{ $hotel->booking_validity_from }} - To
                                {{ $hotel->booking_validity_to }}</p>
                        </div>
                        @if (!empty($hotel->blackout_dates))
                            <div class="col-sm-3">
                                <p class="title">Blackout days:</p>
                            </div>
                            <div class="col-sm-3">
                                <p class="desc">{{ $hotel->blackout_dates }}</p>
                            </div>
                        @endif

                        <div class="col-sm-12">
                            <p class="title">Descriptions:</p>
                        </div>
                        <div class="col-sm-12 text-center">
                            <div class="paragraph truncate">{!! $hotel->description !!}</div>
                            @if(strlen($hotel->description) > 320)
                                <a href="javascript::" class="readmore text-primary">Read More..</a>
                            @endif
                        </div>
                    </div>
                    <div class="row py-3">
                        <h3 class="border-bottom">Reason to book the hotel</h3>
                        <ol class="superlist">
                            @foreach ($hotel->reasons_to_book as $reason)
                                <li class="superitem">{{ $reason }}</li>
                            @endforeach
                        </ol>
                    </div>
                    <div class="row py-3">
                        <h3 class="border-bottom">Other Policies</h3>
                        @foreach ($hotel->other_policies as $key => $policy)
                            <div class="col-sm-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $policy['name'] }}</h5>
                                        <p class="card-text">{{ $policy['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row py-3">
                        @php
                            foreach ($hotel->amenity->pluck('sub_amenity_id', 'amenity_id') as $key => $value) {
                                $amenities[$key][] = $value;
                                $modelAmenity = getActiveAmenities();
                            }
                        @endphp
                        <h3 class="border-bottom">Available Amenities</h3>
                        @foreach ($amenities as $amenity => $sub_amenity)
                            <div class="col-sm-3">
                                <p class="title">{{ $modelAmenity->where('id',$amenity)->first()->amenities_name }}</p>
                                @if ($sub_amenity[0] != null)
                                    <ul class="parent-list">
                                        @foreach ($sub_amenity as $sub_amen)
                                            @if($sub_amen != null)
                                                <li class="desc sub-list">{{ $modelAmenity->where('id', $amenity)->first()->sub_amenities->where('id',$sub_amen)->first()->sub_amenities_name ?? null }}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div class="row py-3">
                        <h3 class="border-bottom">Terms / Cancallation / Cofirmation message</h3>
                        @if ($hotel->cancel_policy != null)
                            <div class="col-sm-6 ">
                                <label class="title">Cancellation Policy</label>
                                <div class="scrollable">{!! $hotel->cancel_policy !!}</div>
                            </div>
                        @endif
                        @if ($hotel->terms_conditions != null)
                            <div class="col-sm-6 ">
                                <label class="title">Terms & Condition</label>
                                <div class="scrollable">{!! $hotel->terms_conditions !!}</div>
                            </div>
                        @endif
                        @if ($hotel->confirm_message != null)
                            <div class="col-sm-6 ">
                                <label class="title">Confirmation Message</label>
                                <div class="scrollable">{!! $hotel->confirm_message !!}</div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-sm-2">
                    <a href="{{ url()->previous()}}" class="btn btn-info btn-rounded"><i class="fa fa-backward" aria-hidden="true"></i> back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).on('click', '.readmore', function(){
            $(this).siblings().removeClass('truncate')
            $(this).removeClass('readmore').addClass('readless').text('Read Less..');
        })

        $(document).on('click', '.readless', function(){
            $(this).siblings().addClass('truncate')
            $(this).addClass('readmore').removeClass('readless').text('Read More..');
        })
    </script>
@endpush
