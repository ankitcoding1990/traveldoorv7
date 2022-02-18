@php
    if(isset($isSupplier)){
        $layout = 'supplier::layouts.master';
        $section = 'content';
    }else{
        $layout = 'layouts.main';
        $section = 'main';
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
@section('title','View Restaurant')
@section($section)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                <h1 class="my-2 border-bottom">Basic</h1>
                <div class="row">
                    <div class="col-sm-2"><label class="title">Restaurant Name:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->name}}</label></div>
                    <div class="col-sm-2"><label class="title">Type:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->getRestaurantType->restaurant_type_name }}</label></div>
                    <div class="col-sm-2"><label class="title">Owner Name:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->owner_name}}</label></div>
                    <div class="col-sm-2"><label class="title">E-Mail:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->email}}</label></div>
                    <div class="col-sm-2"><label class="title">Contact Number:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->contact}}</label></div>
                    <div class="col-sm-2"><label class="title">Address:</label></div>
                    <div class="col-sm-4"><label class="desc">{{$model->address}}</label></div>
                    <div class="col-sm-2"><label class="title">Supplier:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ getSuppliers($model->supplier_id)->name }}</label></div>
                  
                    <div class="col-sm-2"><label class="title">Country:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ countries($model->country_id)->country_name }}</label></div>
                    <div class="col-sm-2"><label class="title">City:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ getSelectedCity($model->city_id)->name }}</label></div>
                    
                    <div class="col-sm-2"><label class="title">Validity</label></div>
                    <div class="col-sm-4"><label class="desc">{{ $model->valid_from_date }} To {{ $model->valid_to_date }}</label></div>
                    <div class="col-sm-2"><label class="title">Timings:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ $model->valid_from_time }} To {{ $model->valid_to_time }}</label></div>
                    {{-- <div class="col-sm-2"><label class="title">Currency</label></div>
                    <div class="col-sm-4"><label class="desc">{{ activeCurrencies($model->currency)->name }}</label></div> --}}
                    
                    <div class="col-sm-2"><label class="title">No Of Tables:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ $model->no_of_tables }}</label></div>
                    {{-- <div class="col-sm-2"><label class="title">Status:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ $model->valid_to_date }}</label></div>
                    <div class="col-sm-2"><label class="title">Approve Status:</label></div>
                    <div class="col-sm-4"><label class="desc">{{ $model->valid_to_date }}</label></div> --}}

                    <div class="col-sm-2"><label class="title">Blackout Days:</label></div>
                    <div class="col-sm-10">
                        @if ($model->blackout_days!=null)
                            @foreach (explode(',' , $model->blackout_days) as $key => $days)
                                <label class=" badge bg-{{ $bs_color[rand(0,5)] }} ">{{ $days }}</label>
                            @endforeach
                        @endif
                    </div>
                   
                </div>
                <div class="row">
                    <div class="col-sm-2"><label class="title">Available Days</label></div>
                    <div class="col-sm-10">
                        @foreach($model->restaurant_available_days as $day => $bool)
                            @if($bool == 'yes')
                                <label class="badge bg-{{ $bs_color[rand(0,5)] }} p-1"> {{$day}} </label>
                            @endif
                        @endforeach
                    </div>
                </div>

                <h1 class="my-2 border-bottom">Descriptions</h1>
                <div class="row">
                    @if ($model->description != null)
                        <div class="col-sm-6 ">
                            <label class="title">Description</label>
                            <div class="scrollable">{!! $model->description !!}</div>
                        </div>
                    @endif
                </div>
                <h1 class="my-2 border-bottom">Images</h1>
                <div class="row">
                    @foreach ($images as $key => $value)
                        <div class="col-sm-3">
                            <div class="card">
                                <img src="{{ $value->getRestaurantImageUrlAttribute()}}" alt="image-{{$key}}">
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

