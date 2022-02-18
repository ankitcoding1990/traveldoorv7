<input type="hidden" name="amenities_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
{!! Form::hidden('amenities_status', null) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Amenities Name <span class="asterisk">*</span></label>
            {!! Form::text('amenities_name', null , ['class' => 'form-control validate', 'id' => 'amenities_name', 'autofocus', 'placeholder' => 'Name']) !!}
            @error('amenities_name')
                <p class="text text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>
</div>
