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
        /* img{
            width: 30%;
        } */
    </style>
@endpush
@section('title','PDF Details')

@section('main')

@if (true)
    @if(isset($pdf))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">{{$pdf->title}}</h4>
                </div>
                <div class="box-body" >
                    <div class='row inner-box'>
                        <div class="col-sm-2"><strong>Descriptions:</strong></div>
                        <div class="col-sm-10">{{$pdf->about_text}}</div>
                        <div class="col-sm-2"><strong>Ending With:</strong></div>
                        <div class="col-sm-10">{{$pdf->content_desciption}}</div>
                        <div class="col-sm-2"><strong>About Us:</strong></div>
                        @if($pdf->about_image)
                            <div class="col-sm-4"><img src='{{$pdf->about_image}}' alt="Fail To Load"/></div>
                        @else
                        <div style="text-align:center">
                            <div class="text-primary" style="font-size: 3rem;"><i class="fa fa-close" aria-hidden="true"></i></div>
                            <label class="text-danger">No Previous Uploaded Image</label>
                        </div>
                        @endif
                        <div class="col-sm-2"><strong>Contact Us:</strong></div>
                        @if($pdf->contact_image)
                            <div class="col-sm-4"><img src='{{$pdf->contact_image}}' alt="Fail To Load"/></div>
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
    <div><a href="{{url()->previous()}}" class="btn btn-primary"><i class="fa fa-backward" aria-hidden="true"></i> Back</a href="{{url()->previous()}}"></div>
    @else

    @endif
@else
    <h4 class="text-danger">NO Data Available</h4>
@endif
@endsection
