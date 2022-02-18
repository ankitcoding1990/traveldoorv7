{!! Form::select('country_id', $countries->pluck('country_name','id'), $selected_country, ['class' => 'form-control select2', 'placeholder' => 'Select Country', 'onchange'=>'getCitiesOnChangeCountry($(this).val())']) !!}
<div class="invalid-feedback d-block">
</div>