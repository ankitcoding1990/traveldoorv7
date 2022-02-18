<div class="row border-bottom">
    <div class="col-sm-5">
        <div class="form-group">
            <label>Customer name</label>
            {!! Form::text('customer_name', null, ['class' => 'form-control' ,'id' => 'customer_name', 'placeholder' => 'Name']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Organisation name</label>
            {!! Form::text('organization_name', null, ['class' => 'form-control', 'id' => 'organization_name', 'placeholder' => 'Organisation']) !!}
        </div>
    </div>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-md">
                <div class="form-group">
                    <label>Customer Contact</label>
                    {!! Form::text('customer_contact', '+995', ['class' => 'form-control', 'id' => 'customer_contact', 'placeholder' => 'Contact','maxlength' => '15']) !!}
                </div>
            </div>
            <div class="col-sm-1 py-4 text-center">
                <p> -OR- </p>
            </div>
            <div class="col-md">
                <div class="form-group">
                    <label>Customer Email</label>
                    {!! Form::email('customer_email', null, ['class' => 'form-control' ,'id' => 'customer_email','placeholder' => 'Email']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Enquiry Type</label>
            {!! Form::select('enquiry_type', getEnquiriesType(), null, ['class' => 'form-control' ,'id' => 'enquiry_type']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Nationality</label>
            {!! Form::select('national', getNationalities(), null, ['class' => 'form-control' ,'id' => 'national']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Residence Country</label>
            {!! Form::select('customer_country', getCountries(), null, ['class' => 'form-control' ,'id' => 'customer_country']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>City</label>
            <select name="customer_city" id="customer_city" class="form-control">
                <option value disabled selected hidden> --Select Country First--</option>
            </select>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Travel dates</label>
            <div class="input-group">
                {!! Form::text('booking_range', null, ['class' => 'form-control pull-right','id' => 'booking_range','placeholder' => 'Select Date']) !!}
                <div class="input-group-addon" onclick="$(this).siblings('input').focus()">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Adults</label>
                    {!! Form::number('no_of_adults', null, ['class' => 'form-control' ,'id' => 'no_of_adults','placeholder' => 'Adult Count']) !!}
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <label>Kids</label>
                    {!! Form::number('no_of_kids', null, ['class' => 'form-control' ,'id' => 'no_of_kids','placeholder' => 'Kids Count']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Hotel Type</label>
            {!! Form::select('hotel_type', ['Apartment' => 'Apartment','Hotel' => 'Hotel'], null, ['class' => 'form-control','id' => 'hotel_type','placeholder' => '--Select Hotel Type--']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Budget Type</label>
            {!! Form::text('budget_type', null, ['class' => 'form-control','id' => 'budget_type','placeholder' => 'Estimation']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Enquiry Source</label>
            {!! Form::select('enquiry_source', ['Facebook' => 'Facebook','Call' => 'Call','Email' => 'Email','Offline' => 'Offline','Whatsapp' => 'Whatsapp','Instagram' =>'Instagram','Website' => 'Website'], null, ['class' => 'form-control','id' => 'enquiry_source','']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Prospect</label>
            {!! Form::select('enquiry_prospect', ['hot' => 'Hot','warm' => 'Warm','cold' => 'Cold'],null, ['class' => 'form-control' ,'id' => 'enquiry_prospect','placeholder' => '-- Select Prospect--']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Status</label>
            {!! Form::select('enquiry_status', ['open' => 'Open','win' => 'Win','refused' => 'Refused', 'cancelled' => 'Cancelled','itsent' => 'IT Sent'], null, ['class' => 'form-control','id' => 'enquiry_status','placeholder' => '-- Select Status--']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Assign To</label>
            {!! Form::select('assigned_to', getUsersList(), null, ['class' => 'form-control' ,'id' => 'assigned_to', 'placeholder' => '-- Select Operator --']) !!}
        </div>
    </div>
    <div class="col-sm-5">
        <div class="form-group">
            <label>Next Followup</label>
            <div class="input-group">
                {!! Form::text('nxt_followup_date', null, ['class' => 'form-control pull-right','id' => 'nxt_followup_date','placeholder' => 'Select Date']) !!}
                <div class="input-group-addon" onclick="$(this).siblings('input').focus()">
                    <i class="fa fa-calendar"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row border-bottom my-3">
    <div class="col-sm-5 border-right">
        <h4 class="box-title">Departure City</h4>
        <div class="form-group">
           <div class="row">
               <div class="col-sm-6">
                    <label>Country</label>
                    {!! Form::select('departure_country', getCountries(), null, ['class' => 'form-control','id' => 'departure_country']) !!}
                </div>
               <div class="col-sm-6">
                   <label>City</label>
                   <select name="departure_city" id="departure_city" class="form-control">
                        <option value disabled selected hidden> --Select Country First--</option>
                    </select>
               </div>
           </div>
        </div>
    </div>
    <div class="col-sm-7">
        <h4 class="box-title">Destinations</h4>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-5">
                     <label>Country</label>
                     {!! Form::select('enqui', getCountries(), null, ['class' => 'form-control','id' => 'departure_country']) !!}
                 </div>
                <div class="col-sm-5">
                    <label>City</label>
                    <select name="departure_city" id="departure_city" class="form-control">
                         <option value disabled selected hidden> --Select Country First--</option>
                     </select>
                </div>
                <div class="col-sm-2 py-1" style="margin-top: 1.7rem;">
                    <button type="button" class="btn btn-primary pull-right "><i class="fa fa-plus-square-o" aria-hidden="true"></i> More</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row border-bottom">
    <div class="col-sm-6">
        <div class="form-group">
            <label>Comments</label>
            {!! Form::textarea('comments', null, ['class' => 'form-control' ,'id' => 'comments','placeholder' => 'Comments','rows' => '7']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            <label>Upload Attachment</label>
            <div class="file" onclick="document.getElementById('image').click()">
                {!! Form::file('image', ['class' => 'form-control hide','id' => 'image','accept' => 'image/*','onchange' => 'previewFile()']) !!}
                <label for="file" id="file-label"><i class="fa fa-plus" aria-hidden="true"></i> Choose a Image</label>
                <img src="" class="preview-img" style="display: none">
            </div>
        </div>
    </div>
</div>
