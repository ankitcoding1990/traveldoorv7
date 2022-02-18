<div class="row">
    <div class="col-md-12 bank_div" id="bank_div" style="padding:0">
        <div class="col-sm-12 {{$class}}">
            <div class="form-group">
                <input type="hidden" name="bank_details[id][]" id="bank_id" value="{{$bank->id ?? NULL}}">
                <label>ACCOUNT NUMBER <span class="asterisk">*</span></label>
                <input type="text" class="form-control" placeholder="ACCOUNT NUMBER" id="account_number" name="bank_details[account_number][]" value="{{$bank->account_number ?? ''}}">
            </div>
            @error('bank_detail.account_number.0')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-sm-12 {{$class}}">
            <div class="form-group">
                <label>BANK NAME <span class="asterisk">*</span></label>
                <input type="text" class="form-control" placeholder="BANK NAME" id="bank_name" name="bank_details[name][]" value="{{$bank->name ?? ''}}">
            </div>
            @error('bank_detail.name.0')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-sm-12 {{$class}}">
            <div class="form-group">
                <label>BANK SWIFT CODE <span class="asterisk">*</span></label>
                <input type="text" class="form-control" placeholder="BANK Swift CODE" id="bank_swift" name="bank_details[swift][]" value="{{$bank->swift ?? ''}}">
            </div>
            @error('bank_detail.swift.0')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-sm-12 {{$class}}">
            <div class="form-group">
                <label>BANK IBAN CODE <span class="asterisk">*</span></label>
                <input type="text" class="form-control" placeholder="BANK IBAN CODE" id="bank_iban" name="bank_details[iban][]" value="{{$bank->iban ?? ''}}">
            </div>
            @error('bank_detail.iban.0')
                <p class="text-danger">{{$message}}</p>
            @enderror
        </div>
        <div class="col-sm-12 {{$class}}">
            <div class="form-group">
                <div class="form-group">
                    <label>CURRENCY <span class="asterisk">*</span></label>
                    {!! Form::select('bank_details[currency][]', $currency->pluck('name','id'),$bank->currency ?? null, [ 'tabindex'=>'-1', 'class'=>'form-control', 'id'=>'currency']) !!}
                </div>
                @error('bank_detail.currency.0')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
        </div>
    </div>
</div>