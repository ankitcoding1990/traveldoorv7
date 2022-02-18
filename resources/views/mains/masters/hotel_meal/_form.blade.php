<input type="hidden" name="language_created_by" value="{{auth()->id()}}">
{!! Form::hidden('id', null ) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Hotel Meal Name <span class="asterisk">*</span></label>
            {!! Form::text('hotel_meals_name', null , ['class' => 'form-control validate', 'id' => 'hotel_meal_name', 'placeholder' => 'Name', 'autofocus']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
