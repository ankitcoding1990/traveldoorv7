{!! Form::hidden('expense_type', $expense_type, ['id' => 'expense_type']) !!}
{!! Form::hidden('id', null, ['id'=>'expense_id']) !!}
{!! Form::hidden('expense_created_by', session()->get('travel_users_id'), ['id' => 'expense_created_by']) !!}
<div class="row mb-10">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <label>Expense Category<span class="asterisk">*</span></label>
            <input type="hidden" name="expense_type" id="expense_type" value="{{$expense_type}}">
            {!! Form::select('expense_category_id', $fetch_expense_category, null, ['id' => 'expense_category_id' , 'class' => 'form-control select2','style' => 'width: 100%']) !!}
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <label>Occured On <span class="asterisk">*</span></label>
            <div class='input-group date' id='datetimepicker1'>
                {!! Form::text('expense_occured_on', null, ["class" => "form-control isAlpaNumeric", 'placeholder' => 'Select Date & Time' , 'readonly' => 'readonly' ,'id'=>"expense_occured_on"]) !!}
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                <div class="invalid-feedback"></div>
            </div>
        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <label>Amount <span class="asterisk">*</span></label>
            {!! Form::text('expense_amount', null, ['placeholder' => 'Enter Amount' , 'id' => 'expense_amount' , 'class' => 'form-control', 'onkeypress' => 'javascript:return validateNumber(event)' ,'onpaste' => 'javascript:return validateNumber(event)']) !!}
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <label>Remarks <span class="text-info">(optional)</span></label>
            {!! Form::textarea('expense_remarks', null, ['class' => 'form-control' , 'placeholder' => 'Enter Remarks Here...', 'id' => 'expense_remarks','rows' => '3']) !!}
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div>