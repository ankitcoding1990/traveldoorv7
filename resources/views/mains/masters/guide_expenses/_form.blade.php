<input type="hidden" name="guide_expense_created_by" value="{{auth()->user()->id}}">
{!! Form::hidden('id', null) !!}
<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Guide Expenses Name <span class="asterisk">*</span></label>
            {!! Form::select('guide_expense',['HOTEL COST'=>'HOTEL COST','FOOD COST'=>'FOOD COST'], $selected, ['class' => 'form-control validate', 'placeholder' => '--Select Guide expense name--', 'autofocus', 'id' => 'guide_expense_name']) !!}
           <span class="invalid-feedback"></span>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Guide Expenses Cost <span class="asterisk">*</span></label>
            {!! Form::text('guide_expense_cost',null, ['class' => 'form-control isNumeric validate', 'id' => 'guide_expense_cost', 'autofocus', 'placeholder' => 'Guide Expenses Cost']) !!}
            <span class="invalid-feedback"></span>
        </div>
    </div>
</div>
