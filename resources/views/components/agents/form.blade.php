
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>AGENT NAME <span class="asterisk">*</span></label>
            {!! Form::text('name', $agent->name ?? null, ['class' => 'form-control', 'placeholder' => 'Agent Name', 'id' => 'agent_name']) !!}
        </div>

    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label>COMPANY NAME <span class="asterisk">*</span></label>
            {!! Form::text('company_name', $agent->company_name ?? null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'id' => 'company_name']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label> COMPANY EMAIL ID <span class="asterisk">*</span></label>
            {!! Form::email('company_email', $agent->company_email ?? null, ['class' => 'form-control', 'placeholder' => 'Company Email ID', 'id' => 'comapny_email_id']) !!}
        </div>
    </div>

</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>EMAIL ID <span class="asterisk">*</span></label>
            {!! Form::email('email', $agent->email ?? null, ['class' => 'form-control', 'placeholder' => 'Email ID', 'id' => 'email_id']) !!}
        </div>
    </div>
    @if(!$agent)
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="form-group">
                <label>Password <span class="asterisk">*</span></label>
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'id' => 'password', 'autocomplete' => 'off']) !!}
            </div>
        </div>

        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="form-group">
                <label>Confirm Password<span class="asterisk">*</span></label>
                {!! Form::password('password_confirmation',  ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'id' => 'ConfirmPassword', 'autocomplete' => 'off'  ]) !!}
            </div>
        </div>
    @endif
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>CONTACT NUMBER <span class="asterisk">*</span></label>
            {!! Form::text('company_contact', $agent->company_contact ?? null, ['class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'id' => 'contact_number', 'autocomplete' => 'off']) !!}
        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>FAX NUMBER</label>
            {!! Form::text('company_fax', $agent->company_fax ?? null, ['class' => 'form-control', 'placeholder' => 'FAX NUMBER', 'id' => 'fax_number', 'autocomplete' => 'off']) !!}
        </div>
    </div>
    @if ($isAdmin)
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="form-group">
                <label>Agent Reference ID <span class="asterisk">*</span></label>
                {!! Form::select('user_ref_id', getUsersList(), $agent->user_ref_id ?? null, ['id' => 'agent_reference_id', 'class' => 'form-control select2', 'placeholder' => 'SELECT USER/OPREATOR']) !!}
            </div>
        </div>
    @endif
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>COUNTRY <span class="asterisk">*</span></label>
            {!! Form::select('country_id', getCountries(), $agent->country_id ?? null, ['id' => 'agent_country', 'class' => 'form-control select2', 'tabindex' => '-1', 'placeholder' => 'SELECT COUNTRY']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group" id="city_div">
            {{-- style="display:{{ isset($cities) && $cities->count() ? 'block' : 'none' }}" --}}
            <label for="agent_city">CITY <span class="asterisk">*</span></label>
            @if (isset($agent))
            {!! Form::select('city_id', getSelectedCity($agent->city_id)->pluck('name', 'id'), $agent->city_id ?? null, ['id' => 'agent_city', 'class' => 'form-control select2', 'tabindex' => '-1', 'placeholder' => 'SELECT COUNTRY FIRST']) !!}

            @else
            <select id="agent_city" name="city_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="" hidden>SELECT COUNTRY FIRST</option>
                @isset($agent)
                    @foreach ($cities as $key => $city)
                        <option selected="{{ $city->id == $agent->city_id }}" value="{{ $city->id }}" hidden>
                            {{ $city->name }}</option>
                    @endforeach
                @endisset
            </select>

            @endif

        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CORPORATE REG. NO </label>
            {!! Form::text('corporate_reg_no', $agent->corporate_reg_no ?? null, ['class' => 'form-control', 'placeholder' => 'CORPORATE REG NO', 'id' => 'corporate_reg_no']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>SKYPE ID </label>
            {!! Form::text('skype_id', $agent->skype_id ?? null, ['id' => 'skype_id', 'class' => 'form-control', 'placeholder' => 'SKYPE ID']) !!}
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CORPORATE DESCRIPTION </label>
            {!! Form::textarea('corporate_desc', $agent->corporate_desc ?? null, ['class' => 'form-control', 'id' => 'corporate_description', 'placeholder' => 'CORPORATE DESCRIPTION', 'rows' => 5, 'cols' => 5]) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>ADDRESS LINE 1 <span class="asterisk">*</span></label>
            {!! Form::textarea('address', $agent->address ?? null, ['class' => 'form-control', 'placeholder' => 'ADDRESS', 'id' => 'address', 'rows' => 5, 'cols' => 5]) !!}
        </div>
    </div>

</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>OPERATION HRS FROM </label>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::text('operating_hrs_from', null, ['class' => 'form-control timepicker', 'id' => 'operating_hrs_from']) !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>OPERATION HRS TO </label>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::text('operating_hrs_to', null, ['class' => 'form-control timepicker', 'id' => 'operating_hrs_to']) !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                    </div>
                    <!-- /.input group -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
    </div>
</div>
<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6 jumbotron">
        <div class="row mb-10">
            @php
                if (isset($agent)) {
                    $weekdays = $agent->operating_weekdays;
                }
            @endphp
            @php
                $operatingWeekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            @endphp

            <div class="col-sm-12">
                @foreach ($operatingWeekdays as $key => $operationWeek)
                    @php
                        $checkOprationWeekYes = '';
                        $checkOprationWeekNo = '';
                    @endphp

                    @if (isset($agent))

                        @php
                            if ($weekdays != null) {
                                if ($weekdays[$operationWeek] == 'yes') {
                                    $checkOprationWeekYes = 'checked';
                                }
                                if ($weekdays[$operationWeek] == 'no') {
                                    $checkOprationWeekNo = 'checked';
                                }
                            }
                        @endphp
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <label>{{ strtoupper($operationWeek) }} <span class="asterisk">*</span></label>
                        </div>
                        <div class="col-md-6">
                            <input name="operating_weekdays[{{ $operationWeek }}]" type="radio"
                                id="week_{{ $operationWeek }}_1" class="with-gap radio-col-primary" value="yes"
                                {{ $checkOprationWeekYes }}>
                            <label for="week_{{ $operationWeek }}_1">Yes </label>
                            <input name="operating_weekdays[{{ $operationWeek }}]" type="radio"
                                id="week_{{ $operationWeek }}_2" class="with-gap radio-col-primary" value="no"
                                {{ $checkOprationWeekNo }}>
                            <label for="week_{{ $operationWeek }}_2">No</label>
                        </div>
                        @error('operating_weekdays')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CERTIFICATE OF CORPORATION </label>
            <div class="file" onclick="document.getElementById('upload_certificate').click()">
                {!! Form::file('agent_certificate_file', ['class' => 'form-control hide', 'id' => 'upload_certificate', 'accept' => 'image/*', 'onchange' => 'previewFile("upload_certificate","preview-certificate","certificate-label")']) !!}

                @if (isset($agent))
                    <label for="file" id="certificate-label" style="display: none"><i class="fa fa-plus"
                            aria-hidden="true"></i>
                        CHOOSE
                        CERTIFICATE</label>
                    {!! Form::hidden('agent_certificate_file_old', $agent->certificate_corp ?? null) !!}
                    <img src="{{ asset('assets/uploads/agent_certificates') }}/{{ $agent->certificate_corp }}"
                        id="preview-certificate">
                @else
                    <label for="file" id="certificate-label"><i class="fa fa-plus" aria-hidden="true"></i>
                        CHOOSE
                        CERTIFICATE</label>
                    <img src="" id="preview-certificate" style="display: none">
                @endif

            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>LOGO</label>


            <div class="file" onclick="document.getElementById('upload_logo').click()">
                {!! Form::file('agent_logo_file', ['class' => 'form-control hide', 'id' => 'upload_logo', 'accept' => 'image/*', 'onchange' => 'previewFile("upload_logo","preview-logo","logo-label")']) !!}

                @if (isset($agent))
                    <label for="file" id="logo-label" style="display: none"><i class="fa fa-plus"
                            aria-hidden="true"></i> CHOOSE
                        LOGO</label>
                    {!! Form::hidden('agent_logo_file_old', $agent->agent_logo ?? null) !!}
                    <img src="{{ asset('assets/uploads/agent_logos') }}/{{ $agent->agent_logo }}" id="preview-logo">

                @else
                    <label for="file" id="logo-label"><i class="fa fa-plus" aria-hidden="true"></i> CHOOSE
                        LOGO</label>
                    <img src="" id="preview-logo" style="display: none">
            </div>
            @endif
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>AGENT CURRENCY <span class="asterisk">*</span></label>
            {!! Form::select('opr_currency[]', $currency->pluck('full_name', 'id'), $agent->opr_currency ?? null, ['id' => 'agent_opr_currency', 'class' => 'form-control select2', 'style' => 'width: 100%', 'tabindex' => '-1', 'aria-hidden' => 'true', 'multiple' => 'multiple']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label>AGENT COUNTRY OF OPERATION <span class="asterisk">*</span></label>
                {!! Form::select('operate_country_id[]', $countries->pluck('country_name', 'id'), $agent->operate_country_id ?? null, ['id' => 'agent_opr_countries', 'class' => 'form-control select2', 'style' => 'width: 100%', 'tabindex' => '-1', 'aria-hidden' => 'true', 'multiple' => 'multiple']) !!}
            </div>
        </div>
    </div>
</div>
@if (!isset($agent))
    <div class="row mb-10">
        <div class="col-sm-12">
            <div class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">
            </div>
            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                <i class="fa fa-plus-circle"></i> SERVICE BANK DETAIL
            </h4>
        </div>
    </div>
    <div class="col-sm-6  pl-0">
        @include('common.banks._form-inputs')
    </div>


    <div class="row mb-10">
        <div class="col-sm-12 col-md-12 col-lg-6">
        </div>
        <div class="col-sm-12">
            <div class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">
            </div>
            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                <i class="fa fa-plus-circle"></i> SERVICE TYPE DETAIL
            </h4>
        </div>
    </div>
    @include('common.services._form-inputs')

    <div class="row mb-10">
        <div class="col-sm-12">
            <div class="box-header with-border" style="padding: 10px;border-color: #c3c3c3;">
            </div>
            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                <i class="fa fa-plus-circle"></i> CONTACT PERSON
            </h4>
        </div>
    </div>
    {{-- agent content info --}}
    @include('common.contacts._form-inputs')

    @endif
    {{-- /agent content info --}}
    <div class="row mb-10">
        <div class="col-md-12">
            <div class="box-header with-border"
                style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                @if (isset($agent))

                    <button type="submit" id="update_agent" class="btn btn-rounded btn-primary mr-10">Update</button>
                    <button type="submit" id="discard_agent" class="btn btn-rounded btn-primary">Discard</button>
                @else
                    <button type="submit" id="create_agent" class="btn btn-rounded btn-primary mr-10">Save</button>
                    <button type="submit" id="discard_agent" class="btn btn-rounded btn-primary">Discard</button>
                @endif
            </div>
        </div>
    </div>

@push('scripts')
    <script>
        $(document).ready(function() {
            //Initialize Select2 Elements
            $('.select2').select2();
            // $('#agent_opr_currency').select2({
            //     "placeholder": "SELECT CURRENCY",
            // });
            // $('#agent_opr_countries').select2({
            //     "placeholder": "SELECT COUNTRY",
            // });
            // $('#service_type').select2({
            //     "placeholder": "SELECT SERVICE TYPE",
            // });
            $('.timepicker').timepicker({
                showInputs: false,
                interval: 5,
                timeFormat: 'HH:mm:ss',
            });
            var date = new Date();
            date.setDate(date.getDate());
            //Passport validity Date picker
            $('#datepicker').datepicker({
                multidate: true,
                todayHighlight: true,
                format: 'yyyy-mm-dd',
            }).on('changeDate', function(e) {
                var dates = $("#datepicker").datepicker("getDates");
                // console.log(dates.length);
                var datearray = [];
                for ($datecount = 0; $datecount < dates.length; $datecount++) {
                    var datevalues = new Date(dates[$datecount]);
                    var Dates = datevalues.getFullYear() + "-" + ('0' + (datevalues.getMonth() +
                        1)).slice(-2) + "-" + ('0' + datevalues.getDate()).slice(-2);
                    datearray.push(Dates);
                }
                $("#blackout_days").val(datearray.join(","));
            });
        });
    </script>
    <script>
        $("#agent_country").on("change", function() {
            if ($(this).val() != '') {
                $("#city_div").show();
            }
            // getCitiesOnChangeCountry($(this).val());
        });
        $("#discard_agent").on("click", function() {
            window.history.back();
        });
        $(document).on("click", ".add_more_bank", function() {

            var clone_contact = $("#bank_div_1").clone();
            var minus_url = "{!! asset('assets/images/minus_icon.png') !!}";
            var newer_id = $(".bank_div:last").attr("id");
            new_id = newer_id.split('bank_div_');
            new_id = parseInt(new_id[1]) + 1;
            clone_contact.find("input[name='bank_details[account_number][]']").attr("id", "account_number_" +
                    new_id)
                .val("");
            clone_contact.find("input[name='bank_details[account_number][]']").parent().parent().parent().attr("id",
                "bank_div_" + new_id);
            clone_contact.find("input[name='bank_details[bank_name][]']").attr("id", "bank_name_" + new_id).val("");
            clone_contact.find("input[name='bank_details[bank_ifsc][]']").attr("id", "bank_ifsc_" + new_id).val("");
            clone_contact.find("input[name='bank_details[bank_iban][]']").attr("id", "bank_iban_" + new_id).val("");
            clone_contact.find("select[name='bank_details[bank_currency][]']").attr("id", "bank_currency_" + new_id)
                .val(0);
            clone_contact.find(".add_more_bank").attr("src", minus_url);
            clone_contact.find(".add_more_bank").attr("id", "remove_more_bank" + new_id);
            clone_contact.find(".add_more_bank").removeClass('plus-icon add_more_bank').addClass(
                'minus-icon remove_more_bank');
            $(".bank_div:last").after(clone_contact);
        });
        $(document).on("click", ".remove_more_bank", function() {
            var id = this.id;
            var split_id = id.split('remove_more_bank');
            $("#bank_div_" + split_id[1]).remove();
        });
        $(document).on("click", ".add_more_contact", function() {
            var clone_contact = $("#contact_div_1").clone();
            var minus_url = "{!! asset('assets/images/minus_icon.png') !!}";
            var newer_id = $(".contact_div:last").attr("id");
            new_id = newer_id.split('contact_div_');
            new_id = parseInt(new_id[1]) + 1;
            clone_contact.find("input[name='contact_person_name[]']").attr("id", "contact_name_" +
                new_id).val("");
            clone_contact.find("input[name='contact_person_name[]']").parent().parent().parent().parent().attr(
                "id", "contact_div_" + new_id);
            clone_contact.find("input[name='contact_person_number[]']").attr("id", "contact_number_" +
                new_id).val("");
            clone_contact.find("input[name='contact_person_email[]']").attr("id", "contact_email_" +
                new_id).val("");
            clone_contact.find(".add_more_contact").attr("src", minus_url);
            clone_contact.find(".add_more_contact").attr("id", "remove_more_contact" + new_id);
            clone_contact.find(".add_more_contact").removeClass('plus-icon add_more_contact').addClass(
                'minus-icon remove_more_contact');
            $(".contact_div:last").after(clone_contact);
        });
        $(document).on("click", ".remove_more_contact", function() {
            var id = this.id;
            var split_id = id.split('remove_more_contact');
            $("#contact_div_" + split_id[1]).remove();
        });
        $(document).on('input', '.isNumberMarkup', function() {
            $(this).css("border", "1px solid #9e9e9e");
        })
        $(document).on("submit", "#register_agent_form", function(e) {
            e.preventDefault();
            //console.log('ok');
            var agent_name = $("#agent_name").val();
            var company_name = $("#company_name").val();
            var email_id = $("#email_id").val();
            var comapny_email_id = $("#comapny_email_id").val();
            var contact_number = $("#contact_number").val();
            var fax_number = $("#fax_number").val();
            var password = $("#password").val();
            var ConfirmPassword = $("#ConfirmPassword").val();
            var agent_reference_id = $("#agent_reference_id").val();
            var address = $("#address").val();
            var agent_country = $("#agent_country").val();
            var agent_city = $("#agent_city").val();
            var corporate_description = $("#corporate_description").val();
            var week_monday = $("input[name='operating_weekdays[monday]']:checked").val();
            var week_tuesday = $("input[name='operating_weekdays[tuesday]']:checked").val();
            var week_wednesday = $("input[name='operating_weekdays[wednesday]']:checked").val();
            var week_thursday = $("input[name='operating_weekdays[thursday]']:checked").val();
            var week_friday = $("input[name='operating_weekdays[friday]']:checked").val();
            var week_saturday = $("input[name='operating_weekdays[saturday]']:checked").val();
            var week_sunday = $("input[name='operating_weekdays[sunday]']:checked").val();
            var agent_opr_currency = $("#agent_opr_currency").val();
            var agent_opr_countries = $("#agent_opr_countries").val();

            // var blackout_days=$("#blackout_days").val();
            var service_type = $("#service_type").val();
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

            if (agent_name.trim() == "") {
                $("#agent_name").css("border", "1px solid #cf3c63");
            } else {
                $("#agent_name").css("border", "1px solid #9e9e9e");
            }
            if (company_name.trim() == "") {
                $("#company_name").css("border", "1px solid #cf3c63");
            } else {
                $("#company_name").css("border", "1px solid #9e9e9e");
            }
            if (email_id.trim() == "") {
                $("#email_id").css("border", "1px solid #cf3c63");
            } else {
                $("#email_id").css("border", "1px solid #9e9e9e");
            }
            if (email_id.trim() != "" && !regex.test(email_id)) {
                $("#email_id").css("border", "1px solid #cf3c63");
            }
            if (comapny_email_id.trim() == "") {
                $("#comapny_email_id").css("border", "1px solid #cf3c63");
            } else {
                $("#comapny_email_id").css("border", "1px solid #9e9e9e");
            }
            if (comapny_email_id.trim() != "" && !regex.test(comapny_email_id)) {
                $("#comapny_email_id").css("border", "1px solid #cf3c63");
            }
            if (contact_number.trim() == "") {
                $("#contact_number").css("border", "1px solid #cf3c63");
            } else {
                $("#contact_number").css("border", "1px solid #9e9e9e");
            }
            // if (fax_number.trim() == "")
            // {
            //     $("#fax_number").css("border", "1px solid #cf3c63");
            // } else
            // {
            //     $("#fax_number").css("border", "1px solid #9e9e9e");
            // }
            if (password.trim() == "") {
                $("#password").css("border", "1px solid #cf3c63");
            } else {
                $("#password").css("border", "1px solid #9e9e9e");
            }
            if (ConfirmPassword.trim() == "") {
                $("#ConfirmPassword").css("border", "1px solid #cf3c63");
            } else {
                $("#ConfirmPassword").css("border", "1px solid #9e9e9e");
            }
            if (agent_reference_id.trim() == "") {
                $("#agent_reference_id").parent().find('.select2-selection').css("border", "1px solid #cf3c63");
            } else {
                $("#agent_reference_id").parent().find('.select2-selection').css("border", "1px solid #9e9e9e");
            }
            if (address.trim() == "") {
                $("#address").css("border", "1px solid #cf3c63");
            } else {
                $("#address").css("border", "1px solid #9e9e9e");
            }
            if (agent_country.trim() == "") {
                $("#agent_country").parent().find('.select2-selection').css("border", "1px solid #cf3c63");
            } else {
                $("#agent_country").parent().find('.select2-selection').css("border", "1px solid #d9d9d9");
            }
            if (agent_city.trim() == "") {
                $("#agent_city").parent().find('.select2-selection').css("border", "1px solid #cf3c63");
            } else {
                $("#agent_city").parent().find('.select2-selection').css("border", "1px solid #d9d9d9");
            }
            // if (corporate_description.trim() == "") {
            //     $("#corporate_description").css("border", "1px solid #cf3c63");
            // } else {
            //     $("#corporate_description").css("border", "1px solid #9e9e9e");
            // }
            if (!week_monday) {
                $("input[name='operating_weekdays[monday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[monday]']").parent().css("border", "1px solid white");
            }
            if (!week_tuesday) {
                $("input[name='operating_weekdays[tuesday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[tuesday]']").parent().css("border", "1px solid white");
            }
            if (!week_wednesday) {
                $("input[name='operating_weekdays[wednesday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[wednesday]']").parent().css("border", "1px solid white");
            }
            if (!week_thursday) {
                $("input[name='operating_weekdays[thursday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[thursday]']").parent().css("border", "1px solid white");
            }
            if (!week_friday) {
                $("input[name='operating_weekdays[friday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[friday]']").parent().css("border", "1px solid white");
            }
            if (!week_saturday) {
                $("input[name='operating_weekdays[saturday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[saturday]']").parent().css("border", "1px solid white");
            }
            if (!week_sunday) {
                $("input[name='operating_weekdays[sunday]']").parent().css("border", "1px solid #cf3c63");
            } else {
                $("input[name='operating_weekdays[sunday]']").parent().css("border", "1px solid white");
            }
            if (agent_opr_currency == "") {
                $("#agent_opr_currency").parent().find(".select2-selection").css("border", "1px solid #cf3c63");
            } else {
                $("#agent_opr_currency").parent().find(".select2-selection").css("border", "1px solid #d9d9d9");
            }
            if (agent_opr_countries == "") {
                $("#agent_opr_countries").parent().find(".select2-selection").css("border", "1px solid #cf3c63");
            } else {
                $("#agent_opr_countries").parent().find(".select2-selection").css("border", "1px solid #d9d9d9");
            }
            //  if(blackout_days.trim()=="")
            // {
            //     $("#blackout_days").css("border","1px solid #cf3c63");
            // }
            // else
            // {
            //  $("#blackout_days").css("border","1px solid #9e9e9e");
            // }
            // if (service_type == "") {
            //     $("#service_type").parent().find(".select2-selection").css("border", "1px solid #cf3c63");
            // } else {
            //     $("#service_type").parent().find(".select2-selection").css("border", "1px solid #d9d9d9");
            // }
            var service_type = 1;
            var service_type_error = 0;
            $('.agent_service_types').each(function() {
                if ($(this).is(':checked')) {
                    var input = $(this).parent('div').siblings('blockquote').find('input')
                    if ($(input).val().trim() == "") {
                        $(input).css("border", "1px solid #cf3c63");
                        service_type_error++;
                    }
                    service_type++;
                }
            })
            var account_number = 1;
            var account_number_error = 0;
            $("input[name='account_number[]']").each(function() {
                if ($(this).val() == "") {
                    $("#account_number_" + account_number).css("border", "1px solid #cf3c63");
                    $("#account_number_" + account_number).focus();
                    account_number_error++;
                } else {
                    $("#account_number_" + account_number).css("border", "1px solid #9e9e9e");
                }
                account_number++;
            });
            var bank_name = 1;
            var bank_name_error = 0;
            $("input[name='bank_name[]']").each(function() {
                if ($(this).val() == "") {
                    $("#bank_name_" + bank_name).css("border", "1px solid #cf3c63");
                    $("#bank_name_" + bank_name).focus();
                    bank_name_error++;
                } else {
                    $("#bank_name_" + bank_name).css("border", "1px solid #9e9e9e");
                }
                bank_name++;
            });
            var bank_ifsc = 1;
            var bank_ifsc_error = 0;
            $("input[name='bank_ifsc[]']").each(function() {
                if ($(this).val() == "") {
                    $("#bank_ifsc_" + bank_ifsc).css("border", "1px solid #cf3c63");
                    $("#bank_ifsc_" + bank_ifsc).focus();
                    bank_ifsc_error++;
                } else {
                    $("#bank_ifsc_" + bank_ifsc).css("border", "1px solid #9e9e9e");
                }
                bank_ifsc++;
            });
            var bank_iban = 1;
            var bank_iban_error = 0;
            $("input[name='bank_iban[]']").each(function() {
                if ($(this).val() == "") {
                    $("#bank_iban_" + bank_iban).css("border", "1px solid #cf3c63");
                    $("#bank_iban_" + bank_iban).focus();
                    bank_iban_error++;
                } else {
                    $("#bank_iban_" + bank_iban).css("border", "1px solid #9e9e9e");
                }
                bank_iban++;
            });
            var bank_currency = 1;
            var bank_currency_error = 0;
            $("select[name='bank_details[bank_currency][]']").each(function() {
                if ($(this).val() == "0") {
                    $("#bank_currency_" + bank_currency).parent().find('.select2-selection').css("border",
                        "1px solid #cf3c63");
                    $("#bank_currency_" + bank_currency).focus();
                    bank_currency_error++;
                } else {
                    $("#bank_currency_" + bank_currency).parent().find('.select2-selection').css("border",
                        "1px solid #d9d9d9");
                }
                bank_currency++;
            });
            var contact_person_name = 1;
            var contact_person_name_error = 0;
            $("input[name='contact_person_name[]']").each(function() {
                if ($(this).val() == "") {
                    $("#contact_name_" + contact_person_name).css("border",
                        "1px solid #cf3c63");
                    $("#contact_name_" + contact_person_name).focus();
                    contact_person_name_error++;
                } else {
                    $("#contact_name_" + contact_person_name).css("border",
                        "1px solid #9e9e9e");
                }
                contact_person_name++;
            });
            var contact_person_number = 1;
            var contact_person_number_error = 0;
            $("input[name='contact_person_number[]']").each(function() {
                if ($(this).val() == "") {
                    $("#contact_number_" + contact_person_number).css("border",
                        "1px solid #cf3c63");
                    $("#contact_number_" + contact_person_number).focus();
                    contact_person_number_error++;
                } else {
                    $("#contact_number_" + contact_person_number).css("border",
                        "1px solid #9e9e9e");
                }
                contact_person_number++;
            });
            // console.log('ok');
            var contact_person_email = 1;
            var contact_person_email_error = 0;
            $("input[name='contact_person_email[]']").each(function() {
                if ($(this).val() == "") {
                    $("#contact_email_" + contact_person_email).css("border",
                        "1px solid #cf3c63");
                    $("#contact_email_" + contact_person_email).focus();
                    contact_person_email_error++;
                } else if ($(this).val() != "" && !regex.test($(this).val())) {
                    $("#contact_email_" + contact_person_email).css("border",
                        "1px solid #cf3c63");
                    $("#contact_email_" + contact_person_email).focus();
                    contact_person_email_error++;
                } else {
                    $("#contact_email_" + contact_person_email).css("border",
                        "1px solid #9e9e9e");
                }
                contact_person_email++;
            });
            if (agent_name.trim() == "") {
                $("#agent_name").focus();
            } else if (company_name.trim() == "") {
                $("#company_name").focus();
            } else if (email_id.trim() == "") {
                $("#email_id").focus();
            } else if (email_id.trim() != "" && !regex.test(email_id)) {
                $("#email_id").focus();
            } else if (contact_number.trim() == "") {
                $("#contact_number").focus();
            }
            //  else if (fax_number.trim() == "") {
            //     $("#fax_number").focus();
            // }
            else if (agent_reference_id.trim() == "") {
                $("#agent_reference_id").focus();
            } else if (address.trim() == "") {
                $("#address").focus();
            } else if (agent_country.trim() == "") {
                $("#agent_country").focus();
            } else if (agent_city.trim() == "") {
                $("#agent_city").focus();
            }
            // else if (corporate_description.trim() == "0") {
            //     $("#corporate_description").focus();
            // }
            else if (!week_monday) {
                $("input[name='operating_weekdays[monday]']").focus();
            } else if (!week_tuesday) {
                $("input[name='operating_weekdays[tuesday]']").focus();
            } else if (!week_wednesday) {
                $("input[name='operating_weekdays[wednesday]']").focus();
            } else if (!week_thursday) {
                $("input[name='operating_weekdays[thursday]']").focus();
            } else if (!week_friday) {
                $("input[name='operating_weekdays[friday]']").focus();
            } else if (!week_saturday) {
                $("input[name='operating_weekdays[saturday]']").focus();
            } else if (!week_sunday) {
                $("input[name='operating_weekdays[sunday]']").focus();
            } else if (agent_opr_currency == "") {
                $("#agent_opr_currency").focus();
            } else if (agent_opr_countries == "") {
                $("#agent_opr_countries").focus();
            }
            // else if(blackout_days.trim()=="")
            // {
            //     $("#blackout_days").focus();
            // }
            else if (account_number_error > 0) {} else if (bank_name_error > 0) {} else if (bank_ifsc_error >
                0) {} else if (bank_currency_error > 0) {} else if (bank_iban_error > 0) {} else if (
                service_type_error > 0
            ) {
                $(".agent_service_types").focus();
            } else if (contact_person_name_error > 0) {} else if (contact_person_email_error > 0) {} else if (
                contact_person_number_error > 0) {} else {
                // $("#create_agent").prop("disabled", true);
                var formdata = new FormData($("#register_agent_form")[0]);
                // console.log('formsubmit');

                $.ajax({
                    url: $("#register_agent_form").attr('action'),
                    enctype: 'multipart/form-data',
                    data: formdata,
                    type: $("#register_agent_form").attr('method'),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response.status == true) {
                            swal({
                                title: response.title,
                                text: response.message,
                                type: "success"
                            });
                            setTimeout(function() {
                                location.reload();
                            }, 1000)

                        } else {
                            swal({
                                title: response.title,
                                text: response.message,
                                type: "warning"
                            });
                            //swal("ERROR", "Agent cannot be inserted right now! ");
                        }
                        $("#create_agent").prop("disabled", false);
                    },
                    error: function(err) {
                        if (err.responseJSON.message != undefined) {
                            swal({
                                text: err.responseJSON.message,
                                type: "error"
                            });
                        } else {
                            swal({
                                text: err.statusText,
                                type: "error"
                            });
                        }
                    }
                });
            }
        });
    </script>
    <script>
        $(document).on("change", "#agent_country", function() {
            if ($("#agent_country").val() != "0") {
                getcity()
            }
        });

        function getcity() {
            var country = $('#agent_country').val()
            var selected = $('#selected_city').val()
            $('#city_div').show();
            $.ajax({
                type: "get",
                url: '{{ url("getcities") }}',
                data: {
                    'country': country
                },
                success: function(response) {
                    $("#agent_city").show();
                    // console.log(response);
                    if (response) {
                        html = '<option disabled selected hidden> -- Select City -- </option>';
                        $.each(response, function(key, item) {
                            if (key == selected) {
                                html += `<option selected value = ${key}> ${item} </option>`;
                            } else {
                                html += `<option value = ${key}> ${item} </option>`;
                            }
                        })
                    } else {
                        html = '<option disabled selected hidden> -- No City Found -- </option>'
                    }
                    $('#agent_city').html(html)
                    $('#agent_city').select2();
                }
            });
        }
        // $("#select_all").click(function() {
        //     if ($("#select_all").is(':checked')) {
        //         $('#service_type').select2('destroy').find('option').prop('selected', 'selected').end().select2();
        //     } else {
        //         $('#service_type').select2('destroy').find('option').prop('selected', false).end().select2();
        //     }
        // });


        $("#select_all").change(function() {
            //console.log('ok');
            if ($("#select_all").is(':checked')) {
                $('input:checkbox').parent().find('input').prop('checked', this.checked);
                $(this).parent().find('blockquote').show();
            } else {
                $('input:checkbox').parent().find('input').prop('checked', false);
                $(this).parent().find('blockquote').hide();
                $(this).parent().find('input').val('');

            }
        });
    </script>
    <script>
        function previewFile(idOfFileTag, IdOfPreviewTag, IdOfLabelTag) {
            var preview = document.querySelector('#' + IdOfPreviewTag);
            var file = document.querySelector('#' + idOfFileTag).files[0];
            var label = document.querySelector('#' + IdOfLabelTag);
            var reader = new FileReader();
            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = "block";
                label.style.display = 'none';
            }
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
                label.style.display = 'block';
                preview.style.display = "none";
            }
        }
    </script>
    <script>
        $(document).on('keyup', '#password, #ConfirmPassword', function() {
            var password = $('#password').val();
            var confirmPassword = $('#ConfirmPassword').val();
            if (confirmPassword.trim() != '') {
                if (password != confirmPassword) {
                    $('#ConfirmPassword').css('border', 'red 1px solid');
                    if ($('#ConfirmPassword').next().length == 0) {
                        $('#ConfirmPassword').after(
                            "<small class='confirm_has_error text-danger'>Confirm Password Didn't Match With Password</small>"
                        );
                    }
                } else {
                    $('#ConfirmPassword').css('border', '1px solid #CED4DA');
                    if ($('#ConfirmPassword').next().length != 0) {
                        $('#ConfirmPassword').next().remove('.confirm_has_error');
                    }
                }
            }
        });
    </script>
@endpush
