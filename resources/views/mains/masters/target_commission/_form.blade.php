<input type="hidden" name="st_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null ) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Monthly Target Amount <span class="asterisk">*</span></label>
            {!! Form::text('st_amount', null, ['class' => 'form-control', 'id' => 'st_amount', 'autofocus', 'placeholder' => 'Amount']) !!}
            @error('st_amount')
              <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <label>Commission <small>(in %)</small><span class="asterisk">*</span></label>
            {!! Form::text('st_commission_per', null, ['class' => 'form-control textfield', 'id' => 'st_commission_per', 'autofocus', 'placeholder' => 'Per %']) !!}
            @error('st_commission_per')
              <p class="text-danger">{{ $message }}</p>
            @enderror
            {{-- <input type="text" class="form-control textfield" placeholder="ISO 639" id="iso_639_no" name="iso_639_no"> --}}
        </div>
    </div>
</div>
