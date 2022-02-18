<input type="hidden" name="tour_type_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <input type="hidden" name="menu_pid" value="0">
            <label>Tour Type Name <span class="asterisk">*</span></label>
            {!! Form::text('tour_type_name', null, ['class' => 'form-control', 'id' => 'tour_type_name', 'placeholder' => 'Name', 'autofocus']) !!}
            @error('tour_type_name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
