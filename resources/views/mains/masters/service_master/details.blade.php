@extends('layouts.main')

@push('style')
    <style>
        .box-title{
            font-size: 2rem;
        }
        .inner-box{
            font-size: 1.3rem;
            margin: 10px 5px;
        }
    </style>
@endpush
@section('title','View Service')

@section('main')
@if (true)
    @if(isset($service))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{$service->service_name}}</h4>
                </div>
                <div class="box-body" >
                    <div class='row'>
                        <div class="col">
                        <div class="row inner-box">
                            <div class="col-sm-6"><strong>Price Per Pax:</strong></div>
                            <div class="col-sm-6">{{$service->price_per_pax}}</div>
                        </div>
                        <div class="row inner-box">
                            <div class="col-sm-6"><strong>Price(per service):</strong></div>
                            <div class="col-sm-6">{{$service->price_per_service}}</div>
                        </div>
                        <div class="row inner-box">
                            <div class="col-sm-6"><strong>Country:</strong></div>
                            <div class="col-sm-6">{{$service->country}}</div>
                        </div>
                        <div class="row inner-box">
                            <div class="col-sm-6"><strong>Descriptions:</strong></div>
                            <div class="col-sm-6">{{$service->service_description}}</div>
                        </div>
                    </div>
                        <div class="col-sm-4">
                            @if ($service->service_image)
                                <div class="form-group">
                                    <img src="{{$service->service_image}}" alt="Service">
                                </div>
                            @else
                            <div style="text-align:center">
                                <div class="text-primary" style="font-size: 3rem;"><i class="fa fa-close" aria-hidden="true"></i></div>
                                <label class="text-danger">No Previous Uploaded Image</label>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div><a href="{{url()->previous()}}" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> Back</a href="{{url()->previous()}}"></div>
    @else

    @endif
@else
    <h4 class="text-danger">NO Data Available</h4>
@endif
@endsection
