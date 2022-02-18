{!! Form::hidden('id', null, ['id' => 'city_id']) !!}
<div class="row mx-auto my-3">
    <div class="col-sm-6">
        <label for="city">City</label>
        {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'city', 'placeholder' => 'Name', 'autofocus']) !!}
    </div>
</div>
