{!! Form::select('city_id', $cities->pluck('name','id'), $selected_city, ['class' => 'form-control select2', 'placeholder' => 'Select City']) !!}
<div class="invalid-feedback d-block">
</div>