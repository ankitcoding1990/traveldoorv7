
<h3> TOUR DESCRIPTION</h3>
<div class="form-group">
    {!! Form::textarea('tour_desc', $sightseeing->tour_desc ?? null, ['class' => 'form-control', 'id' => 'sightseeing_desc', 'placeholder' => 'Term and conditions']) !!}
</div>


<h3> TOUR ATTRACTIONS</h3>
<div class="form-group">
    {!! Form::textarea('attractions', $sightseeing->attractions ?? null, ['class' => 'form-control', 'id' => 'tour_attractions', 'placeholder' => 'Term and conditions']) !!}
</div>

