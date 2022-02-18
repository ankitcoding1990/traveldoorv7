<input type="hidden" name="customer_markup_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
@php
    $markups = ['Hotel' => 'Hotel','Guide' => 'Guide','Activity' => 'Activity','SightSeeing' => 'SightSeeing','Driver' => 'Driver','Transfer'=>'Transfer','Itinerary' => 'Itinerary','Restaurant' => 'Restaurant'];
@endphp
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Markup Name <span class="asterisk">*</span></label>
            {!! Form::select('customer_markup',$markups, null, ['id' => "customer_markup", 'class' => 'form-control select2','autofocus', 'placeholder' => '--Select Markup--']) !!}
            @error('customer_markup')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Markup Cost <span class="asterisk">*</span></label>
            {!! Form::text('customer_markup_cost', null, ['class' => 'form-control isNumeric', 'id' => 'customer_markup_cost', 'autofocus', 'placeholder' => 'Cost(%)']) !!}
            @error('customer_markup_cost')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
