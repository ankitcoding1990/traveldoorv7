<input type="hidden" name="expense_category_created_by" value="{{session()->get('travel_users_id')}}">
{!! Form::hidden('id', null ) !!}
<div class="row mb-10">
    <div class="col-sm-4 col-md-4">
        <div class="form-group">
            <input type="hidden" name="menu_pid" value="0">
            <label>Expense Category Name <span class="asterisk">*</span></label>
            {!! Form::text('expense_category_name', null, ["class" => "form-control isAlpaNumeric", 'id'=>"expense_category_name", 'autofocus']) !!}
            <div class="invalid-feedback"></div>
        </div>
    </div>
</div>