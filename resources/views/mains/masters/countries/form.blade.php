{!! Form::model($model ?? null, ['id' => 'world_form', 'route' => ['countries.update', $model->id]]) !!}
    <div class="row">
        <div class="col-sm-4">
            <label for="country_name">Country Name</label>
            {!! Form::text('country_name', null, ['class' => 'form-control', 'id' => 'country_name', 'placeholder' => 'Country Name']) !!}
        </div>
        <div class="col-sm-4">
            <label for="country_name">Country Abbrivation</label>
            {!! Form::text('country_abbr', null, ['class' => 'form-control', 'id' => 'country_abbr', 'placeholder' => 'Country abbrivation']) !!}
        </div>
        <div class="col-sm-4">
            <label for="country_name">Country Phone Code</label>
            {!! Form::text('country_code', null, ['class' => 'form-control', 'id' => 'country_code', 'placeholder' => 'Country\'s phone code']) !!}
        </div>
    </div>
{!! Form::close() !!}
