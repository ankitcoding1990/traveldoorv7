
<div class="row">
    @foreach ($fetch_restaurants as $restaurant )
    <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
        <div class="form-group">
            <label for="restaurant_type_id">{{$restaurant->name}} <span class="asterisk">*</span></label>
        </div>
    </div>
    @endforeach
    
</div>