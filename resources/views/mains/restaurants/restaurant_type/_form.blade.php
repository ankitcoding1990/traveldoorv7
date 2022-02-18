<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            {!! Form::hidden('id', null, []) !!}
            <label>Restaurant Type Name <span class="asterisk">*</span></label>
            {!! Form::text('restaurant_type_name',null,['class' => 'form-control', 'placeholder' => 'restaurant_type_name', 'autofocus', 'id' => 'restaurant_type_name']) !!}
            @error('restaurant_type_name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            {{-- <input type="text" class="form-control" placeholder="Name" id="restaurant_type_name" name="restaurant_type_name" autofocus> --}}
        </div>
    </div>
</div>
