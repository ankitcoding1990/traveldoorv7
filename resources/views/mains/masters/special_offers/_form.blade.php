{!! Form::hidden('id', null) !!}
<input type="hidden" name="delimage" id="del">
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Title <span class="asterisk">*</span></label>
            {!! Form::text('title', null, ['class' => 'form-control','placeholder' => 'Title', 'id' => 'title' ,'autofocus']) !!}
            @error('title')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Adult Price<span class="asterisk">*</span></label>
            {!! Form::text('price', null, ['class' => 'form-control set_price', 'placeholder' => 'Price', 'id' => 'price', 'autofocus']) !!}
            @error('price')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Child Price</label>
            {!! Form::text('price_child', null, ['class' => 'form-control set_price', 'placeholder' => 'Price', 'id' => 'price_child','autofocus']) !!}
            @error('price_child')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Infant Price</label>
            {!! Form::text('price_infant', null, ['class' => 'form-control set_price', 'placeholder' => 'Price','id' => 'price_infant','autofocus']) !!}
            @error('price_infant')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Select Itinerary<span class="asterisk">*</span></label>
            {!! Form::select('itinerary_id', getActiveItinaries(), null, ['class' => 'form-control','placeholder' => '-- Select Itinanry --', 'id' =>'itinerary_id']) !!}
            @error('itinerary_id')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Image <span class="asterisk">*</span></label>
            {!! Form::file('image', ['class' => 'form-control image', 'placeholder' => 'Image', 'id' => 'image' ,'accepts' => 'images\*']) !!}
            @error('image')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Package Description <span class="asterisk">*</span></label>
            {!! Form::textarea('description', null, ['class' => 'form-control description' ,'placeholder' => 'Descriptions','autofocus','id' => 'description','rows' => '3']) !!}
            @error('description')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Special Offer Description<span class="asterisk">*</span></label>
            {!! Form::textarea('package', null, ['class' => 'form-control package' ,'placeholder' => 'Package','id' => 'package', 'autofocus','rows' => '3']) !!}
            @error('package')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    @isset($specialOffer)
    <div class="col-sm-4 col-md-4 border-bottom">
        @if($specialOffer->image)
        <div class="form-group">
            <label>Previous Uploaded Image</label><button type="button" class='btn pull-right' onclick='remdiv($(this),"{{$specialOffer->image}}")'><span class="h3">&times;</span></button><br/>
            <img src="/assets/uploads/special offers/{{$specialOffer->image}}" alt="Special offer">
        </div>
        @else
        <div style="text-align:center">
            <div class="text-primary" style="font-size: 3rem;"><i class="fa fa-close" aria-hidden="true"></i></div>
            <label class="text-danger">No Previous Uploaded Image</label>
        </div>
        @endif
    </div>
    @endisset
</div>
{{-- <div class="row md-10 hotel_main_div" id="hotel_main_div__1">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Select Hotels<span class="asterisk">*</span></label>
            <select name="select_hotel" id="select_hotel__1" class="form-control select_hotel">

            </select>
            <input type="hidden" value="" name="hotel_id" id="hotel_id">
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group" style="margin-top: 25px;">
        <button class="btn btn-success add_more_hotel" id="add_more_hotel__1">Add More</button>
        </div>
    </div>
    <div class="row md-10" id="select_hotel_rooms__1">

    </div>
</div> --}}

<div class="row md-12">
    <div class="col-md-4">
        <div class="form-group inclusions">
            <label for="inclusions">Inclusions</label>
            @if(isset($specialOffer['inclusions']));
                @foreach ($specialOffer['inclusions'] as $key => $data)
                    @isset($data)
                        <div class='input-group my-3 inclusionsDiv'>{!! Form::text('inclusions[]', $data, ['class' => 'form-control','placeholder' => 'Including Schema', 'id' => 'inclusions', 'autofocus']) !!}  @if($key > 0)<button type='button' class='btn btn-default' onclick='remdiv($(this))'>&times;</button>@endif</div>
                    @endisset
                @endforeach
            @else
                <div class='input-group my-3 inclusionsDiv'>{!! Form::text('inclusions[]', null, ['class' => 'form-control','placeholder' => 'Including Schema', 'id' => 'inclusions', 'autofocus']) !!} </div>
            @endif
        </div>
    </div>
    <div class="col-md-2" style="margin-top: 40px;">
        <button type="button" class="btn btn-success inclusionsIncrement"><i class="fa fa-plus" aria-hidden="true"></i> More</button>
    </div>
    <div class="col-md-4">
        <div class="form-group exclusions">
            <label for="exclusions">Exclusions</label>
            @if(isset($specialOffer['exclusions']))
                @foreach ($specialOffer['exclusions'] as $key => $data)
                    @isset($data)
                        <div class='input-group my-3 exclusionsDiv'>{!! Form::text('exclusions[]', $data, ['class' => 'form-control','placeholder' => 'Excluding Schema', 'id' => 'exclusions', 'autofocus']) !!}  @if($key > 0)<button type='button' class='btn btn-default' onclick='remdiv($(this))'>&times;</button>@endif</div>
                    @endisset
                @endforeach
            @else
                <div class='input-group my-3 exclusionsDiv'>{!! Form::text('exclusions[]', null, ['class' => 'form-control','placeholder' => 'Excluding Schema', 'id' => 'exclusions', 'autofocus']) !!}  </div>
            @endif
        </div>

    </div>
    <div class="col-md-2" style="margin-top: 40px;">
        <button type="button" class="btn btn-success exclusionsIncrement"><i class="fa fa-plus" aria-hidden="true"></i> More</button>
    </div>
</div>

