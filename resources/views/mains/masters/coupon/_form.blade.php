{!! Form::hidden('id', null) !!}
<input type="hidden" name="coupan_created_by" value="{{auth()->user()->id}}">
<div class="row">
    <div class="col-sm-5">
        <div class="form-group">
            <label>Coupan Type<span class="asterisk">*</span></label>
            {!! Form::select('coupan_type', ['All' => 'All','b2b' => 'B2b','b2c' => 'B2c'], NULL, ['class' => 'form-control','id' => 'coupan_type','placeholder' => '--Select Coupon Type--']) !!}
            @error('coupan_type')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Coupan Name <span class="asterisk">*</span></label>
            {!! Form::text('coupan_name', null, ['class' => 'form-control' ,'id' => 'coupan_name','placeholder' => 'name']) !!}
            @error('coupan_name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>No. of Person<span class="asterisk">*</span></label>
            {!! Form::text('no_of_person', null, ['class' => 'form-control','id' => 'no_of_person','placeholder' => 'Person Quantity']) !!}
            @error('no_of_person')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Minimum Value<span class="asterisk">*</span></label>
            {!! Form::text('min_value', null, ['class' => 'form-control','id' => 'min_value','placeholder' => 'Least Value']) !!}
            @error('min_value')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Select From Date</label>
            <div class="input-group">
                {!! Form::text('coupan_validity_from', null, ['class' => 'form-control datepicker' ,'id' => 'coupan_validity_from' ,'placeholder' => 'Coupon Valid from', 'readonly']) !!}
                <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                @error('coupan_validity_from')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Select To Date</label>
            <div class="input-group">
                {!! Form::text('coupan_validity_to', null, ['class' => 'form-control datepicker' ,'id' => 'coupan_validity_to' ,'placeholder' => 'Coupon Valid To', 'readonly']) !!}
                <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                </div>
                @error('coupan_validity_to')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Coupan Amount Type<span class="asterisk">*</span></label>
        {!! Form::select('coupan_amount_type', ['flat' => 'Flat','Percentage' => 'Percentage'], null, ['class' => 'form-control','id' => 'coupan_amount_type','placeholder' => '--Select Coupon Amount Type--']) !!}
        @error('coupan_amount_type')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Amount / Percentage <span class="asterisk">*</span></label>
            {!! Form::text('coupan_amount', null, ['class' => 'form-control','id' => 'coupan_amount','placeholder' => 'Coupon Ammount']) !!}
            @error('coupan_amount')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Coupan Code <span class="asterisk">*</span></label>
            {!! Form::text('coupan_code', null, ['class' => 'form-control', 'id' => 'coupan_code','placeholder' => 'Click on Genrate Coupon To Generate Coupon Code']) !!}
            <img class="loader" src="\assets\images\loader.gif" style="width:40%"/>
            @error('coupan_code')
            <p class="text-danger">{{ $message }}</p>
            @enderror
        </div>
    </div>
    <div class="col-sm-5" style="margin-top: 1.7rem;">
        <button type="button" id="generate_coupan" class="btn btn-rounded btn-primary mr-10">Generate Coupan</button>
    </div>
</div>
