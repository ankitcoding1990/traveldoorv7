@php
    $viewFull = false;
@endphp
<div class="row">
    <div class="col-md-12 bank_div" id="bank_div_1">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label>ACCOUNT NUMBER <span class="asterisk">*</span></label>
                {!! Form::text('bank_account_number', $bank->account_number ?? null, ['class' => 'form-control validate', 'placeholder' => 'ACCOUNT NUMBER']) !!}
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label>BANK NAME <span class="asterisk">*</span></label>
                {!! Form::text('bank_name', $bank->name ?? null, ['class' => 'form-control validate', 'placeholder' => 'Name']) !!}
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label>BANK IFSC CODE <span class="asterisk">*</span></label>
                {!! Form::text('bank_ifsc', $bank->ifsc ?? null, ['class' => 'form-control validate', 'placeholder' => 'BANK IFSC CODE']) !!}
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <label>BANK IBAN CODE <span class="asterisk">*</span></label>
                {!! Form::text('bank_iban', $bank->iban ?? null, ['class' => 'form-control validate', 'placeholder' => 'BANK IBAN CODE']) !!}
                <div class="invalid-feedback"></div>
            </div>
        </div>
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <div class="form-group">
                    <label>CURRENCY <span class="asterisk">*</span></label>
                    {!! Form::select('bank_currency_id', activeCurrencies()->pluck('full_name', 'id'), $bank->currency_id ?? null, ['tabindex' => '-1', 'class' => 'form-control validate', 'id' => 'currency', 'placeholder' => 'Select Currency']) !!}
                    <div class="invalid-feedback"></div>
                </div>
            </div>
        </div>
    </div>
</div>
