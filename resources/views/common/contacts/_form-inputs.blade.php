<div class="row">
    <div class="col-md-12 contact_div" id="contact_div_1">
        <div class="row mt-20">
            <div class="col-sm-6 col-md-6 ">
                <div class="form-group">
                    <label>Contact Person Name <span class="asterisk">*</span>
                    </label>
                    {!! Form::text('contact_name', $contact->name ?? null, ['class' => 'form-control validate', 'placeholder' => 'Contact Name']) !!}
                    <div class="invalid-feedback">

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label>Phone <span class="asterisk">*</span></label>
                        {!! Form::text('contact_number', $contact->phone ?? null, ['class' => 'form-control validate', 'placeholder' => 'Contact Number']) !!}
                        <div class="invalid-feedback">

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <div class="form-group">
                        <label>WhatsApp Number <span class="asterisk">*</span></label>
                        {!! Form::text('contact_whatsapp', $contact->whatsapp ?? null, ['class' => 'form-control validate', 'placeholder' => 'Contact Whatsapp Number']) !!}
                        <div class="invalid-feedback">

                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6">
                <div class="form-group">
                    <label>EMAIL <span class="asterisk">*</span></label>
                    {!! Form::text('contact_email', $contact->email ?? null, ['class' => 'form-control validate', 'placeholder' => 'example@example.com']) !!}
                    <div class="invalid-feedback">

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
