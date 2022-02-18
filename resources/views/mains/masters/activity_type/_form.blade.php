<input type="hidden" name="activity_type_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Activity Type Name <span class="asterisk">*</span></label>
            {!! Form::text('activity_type_name', null, ['class' => 'form-control', 'id' => 'activity_type_name', 'placeholder' => 'Name', 'autofocus']) !!}
            @error('activity_type_name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
