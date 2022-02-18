<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>AGENT NAME <span class="asterisk">*</span></label>
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Agent Name', 'id' => 'agent_name']) !!}
        </div>

    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label>COMPANY NAME <span class="asterisk">*</span></label>
            {!! Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'id' => 'company_name']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-6 col-lg-4">
        <div class="form-group">
            <label> COMPANY EMAIL ID <span class="asterisk">*</span></label>
            {!! Form::email('company_email', $agent->company_email ?? '', ['class' => 'form-control', 'placeholder' => 'Company Email ID', 'id' => 'comapny_email_id']) !!}
        </div>
    </div>

</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>EMAIL ID <span class="asterisk">*</span></label>
            {!! Form::email('email', $agent->email ?? '', ['class' => 'form-control', 'placeholder' => 'Email ID', 'id' => 'email_id']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>Password <span class="asterisk">*</span></label>
            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'id' => 'password', 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>Confirm Password<span class="asterisk">*</span></label>
            {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'id' => 'ConfirmPassword', 'autocomplete' => 'off']) !!}
        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>CONTACT NUMBER <span class="asterisk">*</span></label>
            {!! Form::text('company_contact', $agent->company_contact ?? '', ['class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'id' => 'contact_number', 'autocomplete' => 'off']) !!}
        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>FAX NUMBER</label>
            {!! Form::text('company_fax', null, ['class' => 'form-control', 'placeholder' => 'FAX NUMBER', 'id' => 'fax_number', 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>Agent Reference ID <span class="asterisk">*</span></label>
            {!! Form::select('user_ref_id', getUsersList(), null, ['id' => 'agent_reference_id', 'class' => 'form-control select2', 'placeholder' => 'SELECT USER/OPREATOR']) !!}
        </div>
    </div>
</div>

<div class="row mb-10">


    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>COUNTRY <span class="asterisk">*</span></label>
            {!! Form::select('country_id', getCountries(), null, ['id' => 'agent_country', 'class' => 'form-control select2', 'tabindex' => '-1', 'placeholder' => 'SELECT COUNTRY']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group" id="city_div">
            {{-- style="display:{{ isset($cities) && $cities->count() ? 'block' : 'none' }}" --}}
            <label for="agent_city">CITY <span class="asterisk">*</span></label>
            <select id="agent_city" name="city_id" class="form-control select2" style="width: 100%;">
                <option selected="selected" value="" hidden>SELECT COUNTRY FIRST</option>
                @isset($agent)
                    @foreach ($cities as $key => $city)
                        <option selected="{{ $city->id == @$agent->agent_city }}" value="{{ $city->id }}" hidden>
                            {{ $city->name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CORPORATE REG. NO </label>
            {!! Form::text('corporate_reg_no', null, ['class' => 'form-control', 'placeholder' => 'CORPORATE REG NO', 'id' => 'corporate_reg_no']) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>SKYPE ID </label>
            {!! Form::text('skype_id', null, ['id' => 'skype_id', 'class' => 'form-control', 'placeholder' => 'SKYPE ID']) !!}
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CORPORATE DESCRIPTION </label>
            {!! Form::textarea('corporate_desc', null, ['class' => 'form-control', 'id' => 'corporate_description', 'placeholder' => 'CORPORATE DESCRIPTION', 'rows' => 5, 'cols' => 5]) !!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>ADDRESS LINE 1 <span class="asterisk">*</span></label>
            {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'ADDRESS', 'id' => 'address', 'rows' => 5, 'cols' => 5]) !!}
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
                $operatingWeekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
            @endphp
            <div class="col-sm-12">
                @foreach ($operatingWeekdays as $key => $operationWeek)
                    @php
                        $checkOprationWeekYes = '';
                        $checkOprationWeekNo = '';
                    @endphp
                    @isset($agent)
                        @php
                            $agentOperationWeeks = unserialize($agent->operating_weekdays);
                            if ($agentOperationWeeks != null) {
                                if ($agentOperationWeeks[$operationWeek] == 'yes') {
                                    $checkOprationWeekYes = 'checked';
                                }
                                if ($agentOperationWeeks[$operationWeek] == 'no') {
                                    $checkOprationWeekNo = 'checked';
                                }
                            }
                        @endphp
                    @endisset
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
                <label for="file" id="certificate-label"><i class="fa fa-plus" aria-hidden="true"></i>
                    CHOOSE
                    CERTIFICATE</label>
                <img src="" id="preview-certificate" style="display: none">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>LOGO</label>
            <div class="file" onclick="document.getElementById('upload_logo').click()">
                {!! Form::file('agent_logo_file', ['class' => 'form-control hide', 'id' => 'upload_logo', 'accept' => 'image/*', 'onchange' => 'previewFile("upload_logo","preview-logo","logo-label")']) !!}
                <label for="file" id="logo-label"><i class="fa fa-plus" aria-hidden="true"></i> CHOOSE
                    LOGO</label>
                <img src="" id="preview-logo" style="display: none">
            </div>
        </div>
    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>AGENT CURRENCY <span class="asterisk">*</span></label>
            <select class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true"
                id="agent_opr_currency" name="opr_currency[]" multiple="multiple">
                @php
                    
                @endphp
                @foreach ($currency as $curr)
                    @php
                        $agentCurrencyCode = '';
                    @endphp
                    @isset($agent)
                        @php
                            $operating_currencies = explode(',', $agent['opr_currency']);
                        @endphp
                        @if (in_array($curr->code, $operating_currencies))
                            @php
                                $agentCurrencyCode = 'selected';
                            @endphp
                        @endif
                    @endisset
                    <option value="{{ $curr->id }}" {{ $agentCurrencyCode }}>{{ $curr->name }}
                        ({{ $curr->code }})</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <div class="form-group">
                <label>AGENT COUNTRY OF OPERATION <span class="asterisk">*</span></label>
                <select class="form-control select2 " style="width: 100%;" tabindex="-1" aria-hidden="true"
                    id="agent_opr_countries" name="operate_country_id[]" multiple="multiple">
                    <option value="0" hidden>SELECT COUNTRY</option>

                    @foreach ($countries_operation as $country)
                        @php
                            $agent_opr_countries_selected = '';
                        @endphp
                        @isset($agent)
                            @php
                                if ($agent->agent_opr_countries == $country->id) {
                                    $agent_opr_countries_selected = 'selected';
                                }
                            @endphp
                        @endisset
                        <option value="{{ $country->id }}" {{ $agent_opr_countries_selected }}>
                            {{ $country->country_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).on("change", "#agent_country", function() {
        if ($("#agent_country").val() != "0") {

            // getCitiesOnChangeCountry($("#agent_country").val());
            var country_id = $(this).val();
            $.ajax({
                url: "{{ route('search-country-cities') }}",
                type: "GET",
                data: {
                    "country_id": country_id
                },
                success: function(response) {
                    $("#agent_city").html(response);
                    $('#agent_city').select2();
                    $("#city_div").show();
                }
            });
        }
    });
    $("#select_all").change(function() {
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
@endpush