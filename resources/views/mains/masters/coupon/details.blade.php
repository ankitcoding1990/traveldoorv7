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
@section('title','View Coupon')

@section('main')

@if (true)
    @if(isset($coupon))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body inner-box">
                    <div class="row">
                        <div class="col-sm-3">Counpan Name:</div>
                        <div class="col-sm-3">{{$coupon->coupan_name}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Counpan Type:</div>
                        <div class="col-sm-3">{{$coupon->coupan_type}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Valid From:</div>
                        <div class="col-sm-3">{{$coupon->coupan_validity_from}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Valid To:</div>
                        <div class="col-sm-3">{{$coupon->coupan_validity_to}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Min Value:</div>
                        <div class="col-sm-3">{{$coupon->min_value}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Amount Type:</div>
                        <div class="col-sm-3">{{$coupon->coupan_amount_type}}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">Counpan Amount:</div>
                        <div class="col-sm-3">{{($coupon->coupan_amount_type == 'Percentage')? $coupon->coupan_amount.'%' : $coupon->coupan_amount}}</div>
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
