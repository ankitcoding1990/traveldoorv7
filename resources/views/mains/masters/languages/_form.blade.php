<input type="hidden" name="language_created_by" value="{{auth()->user()->id}}">
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Language Name <span class="asterisk">*</span></label>
            {!! Form::hidden('id', null ) !!}
            {!! Form::text('language_name', null, ['class' => 'form-control validate', 'id' => 'language_name', 'autofocus', 'placeholder' => 'Name']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
    {{-- <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <input type="hidden" name="menu_pid" value="0">
            <label>ISO 639 CODE <span class="asterisk">*</span></label>
            {!! Form::text('iso_639_no', null, ['class' => 'form-control validate', 'id' => 'iso_639_no', 'autofocus', 'placeholder' => 'ISO 639']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div> --}}
</div>
