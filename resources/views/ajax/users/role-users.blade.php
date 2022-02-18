{!! Form::select('user_id', $users->pluck('name','id'), @$user_id, ['class' => 'form-control select2', 'placeholder' => 'Select A User']) !!}
<div class="invalid-feedback d-block">
</div>