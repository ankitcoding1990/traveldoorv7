<div class="row border-bottom">
    <div class="col-sm-4">
        <div class="form-group">
            <label>Date <small>(From)</small></label>
            {!! Form::text('from_date', null, ['class' => 'form-control datepicker','id' => 'from_date','readonly']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Date <small>(To)</small></label>
            {!! Form::text('to_date', null, ['class' => 'form-control datepicker','id' => 'to_date','readonly']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            <label>Enquiry of</label>
            {!! Form::select('enquiry', ['Enquiry','Special Offers Enquiries','Tour Enquiries'], null, ['class' => 'form-control','id' => 'enquiry']) !!}
        </div>
    </div>
    <div class="col-sm-4 prospect">
        <div class="form-group">
            <label>Prospect</label>
            {!! Form::select('prospect', ['hot' => 'Hot','warm' => 'Warm','cold' => 'Cold'],null, ['class' => 'form-control' ,'id' => 'prospect','placeholder' => 'All']) !!}
        </div>
    </div>
    <div class="col-sm-4 status">
        <div class="form-group">
            <label>Status</label>
            {!! Form::select('status', ['open' => 'Open','win' => 'Win','refused' => 'Refused', 'cancelled' => 'Cancelled','itsent' => 'IT Sent'], null, ['class' => 'form-control','id' => 'status','placeholder' => 'All']) !!}
        </div>
    </div>
    <div class="col-sm-4 enquiry_type">
        <div class="form-group">
            <label>Enquiry Type</label>
            {!! Form::select('enquiry_type', getEnquiriesType(), null, ['class' => 'form-control' ,'id' => 'enquiry_type','placeholder' => 'All']) !!}
        </div>
    </div>
    <div class="col-sm-4 countries">
        <div class="form-group">
            <label>Residence Country</label>
            {!! Form::select('country', getCountries(), null, ['class' => 'form-control' ,'id' => 'country', 'placeholder' => 'All']) !!}
        </div>
    </div>
    <div class="col-sm-4 assignee">
        <div class="form-group">
            <label>Assigned To</label>
            {!! Form::select('assignee', getUsersList(), null, ['class' => 'form-control' ,'id' => 'assignee', 'placeholder' => 'All']) !!}
        </div>
    </div>
</div>
