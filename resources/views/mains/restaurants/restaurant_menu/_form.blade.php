<input type="hidden" name="created_by" value="{{auth()->user()->id}}">
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Menu Category Name <span class="asterisk">*</span></label>
            {!! Form::text('name', null,['class' => 'form-control', 'placeholder' => 'Name', 'autofocus', 'id' => 'restaurant_menu_category_name']) !!}
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
 <div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Menu Category Description</label>
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description','id' => 'restaurant_menu_category_description','rows' =>'2']) !!}
        </div>
    </div>
</div>
