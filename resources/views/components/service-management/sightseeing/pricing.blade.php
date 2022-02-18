
<h3> GROUP TOUR PRICE</h3>
<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">PRICE FOR 1 ADULT </label>
            {!! Form::text('group_adult_cost', $sightseeing->group_adult_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">PRICE FOR 1 CHILD <small>(2 - 10 YEARS)</small>
            </label>
            {!! Form::text('group_child_cost', $sightseeing->group_child_cost ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label for="type">NO OF PAX PER GROUP</label>
            {!! Form::text('group_max_pax', $sightseeing->group_max_pax ?? null, ['class' => 'form-control validate', 'placeholder' => '']) !!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            <label for="type">GROUP TOUR TERMS & CONDITIONS</label>
            {!! Form::textarea('group_tour_terms', $sightseeing->group_tour_terms ?? null, ['class' => 'form-control', 'id' => 'group_tour_terms', 'placeholder' => 'Term and conditions']) !!}
        </div>
    </div>
</div>
