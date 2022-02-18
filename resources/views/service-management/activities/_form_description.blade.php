{!! Form::hidden('activity_id', $id ?? null) !!}
<div class="row">
    <div class="col-sm-12">
        <label> Inclusions </label>
        {!! Form::textarea('inclusions', null, ['class' => 'form-control','id' => 'inclusions']) !!}
    </div>
    <div class="col-sm-12">
        <label> Exclusions </label>
        {!! Form::textarea('exclusions', null, ['class' => 'form-control','id' => 'exclusions']) !!}
    </div>
    <div class="col-sm-12">
        <label> Description </label>
        {!! Form::textarea('description', null, ['class' => 'form-control','id' => 'description']) !!}
    </div>
    <x-service-management.terms-conditions :model="$model ?? null" />
</div>
