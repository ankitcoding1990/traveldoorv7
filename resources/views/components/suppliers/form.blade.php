{{-- @dd("heer"); --}}
@php
    $button = 'Save';
@endphp

@if (isset($supplier) && $supplier != NULL)
    @php
        $button = 'Update';
        if($isAdmin) {
            $url = ['supplier.update',$supplier->id];
        } else {
            $url = ['suppliers.update',$supplier->id];
        }
    @endphp
    {!!Form::model($supplier,['id' => 'supplier_form','method' => 'put', 'files' => true, 'onsubmit' => "ajaxFormSubmit($(this))", 'autocomplete'=> 'off','route' => $url])!!}
@else
    {!!Form::open(['id' => 'supplier_form','method' => 'post', 'files' => true, 'autocomplete'=> 'off','route' => 'suppliers.store', 'onsubmit' => 'return false'])!!}
@endif

<div class="row mb-10">
    <input type="hidden" name="created_by" value="{{auth()->user()->id ?? null}}">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>SUPPLIER NAME <span class="asterisk">*</span></label>
            {!! Form::text('name', $supplier->name ?? null, ['id' => 'supplier_name', 'class' => 'form-control validate', 'placeholder' => 'SUPPLIER NAME']) !!}
                @error('name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>COMPANY NAME <span class="asterisk">*</span></label>
            {!! Form::text('company_name', $supplier->company_name ?? null, ['id' => 'company_name', 'class' => 'form-control validate', 'placeholder' => 'COMPANY NAME']) !!}
                @error('company_name')
                    <p class="text-danger">{{$message}}</p>
                @enderror
                <div class="invalid-feedback">
                </div>
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>EMAIL ID <span class="asterisk">*</span></label>
            {!! Form::text('email', $supplier->email ?? null, ['id' => 'email_id', 'class' => 'form-control validate','placeholder' => 'EMAIL ID']) !!}
            @error('email')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CONTACT NUMBER <span class="asterisk">*</span></label>
                {!! Form::text('company_contact', $supplier->company_contact ?? null, ['id' => 'contact_number', 'class' => 'form-control validate', 'autocomplete' => 'off', 'placeholder' => 'Enter Mobile Number','maxlength' => '12']) !!}
            @error('company_contact')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
    </div>
</div>

<div class="row mb-10" >
    @if (!$isAdmin)
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>Supplier Reference ID <span class="asterisk">*</span></label>
                {!! Form::select('user_ref_id', $users, $supplier->user_ref_id ?? null, ['id' => 'supplier_reference_id', 'class' => 'form-control','placeholder' => '-- Select User/Operator --']) !!}
            @error('user_ref_id')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    @endif
    @if ($isAdmin)
        @if (!$supplier)
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label>Password <span class="asterisk">*</span></label>
                        {!! Form::password('password', ['id' => 'password', 'class' => 'form-control validate','placeholder' => '-- Password --',"autocomplete" => "off"]) !!}
                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
        @endif
    @endif
    @if ($isAdmin)
        @if (!$supplier)
            <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <label>Confirm Password <span class="asterisk">*</span></label>
                        {!! Form::password('password_hint', ['id' => 'confirmPassword', 'class' => 'form-control validate','placeholder' => '-- Confirm Password --',"autocomplete" => "off"]) !!}
                    @error('password')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>



<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label>ADDRESS LINE 1 <span class="asterisk">*</span></label>
            {!! Form::textarea('address', $supplier->address ?? null, ['id' => 'address', 'class' => 'form-control validate' ,'placeholder' => 'ADDRESS' ,'rows' => '5', 'cols' => '5']) !!}
            @error('address')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>COUNTRY <span class="asterisk">*</span></label>
            {!! Form::select('country_id', $countries->pluck('country_name','id'), $supplier->country_id ?? null, ['id' => 'supplier_country', 'class' => 'form-control select2 validate', 'placeholder' => 'SELECT COUNTRY', 'onchange'=>'getCitiesOnChangeCountry($(this).val())']) !!}
        @error('country_id')
            <p class="text-danger">{{$message}}</p>
        @enderror
        <div class="invalid-feedback">
        </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4" id="city_div" style="display:none;">
        <div class="form-group">
            <label>CITY <span class="asterisk">*</span></label>
            <div id="getCityHtml">
                <select id="supplier_city" name="city_id" class="form-control select2 validate" style="width: 100%;">
                    <option selected="selected">SELECT CITY</option>
                </select>
            </div>

            @error('city_id')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-4">
        <div class="form-group">
            <label>CORPORATE REG. NO </label>
            {!! Form::text('corporate_reg_no', $supplier->corporate_reg_no ?? null, ['id' => 'corporate_reg_no', 'class' => 'form-control', 'placeholder' => 'CORPORATE REG NO']) !!}
            <div class="invalid-feedback">
            </div>
        </div>
    </div>

</div>
<div class="row mb-10" >

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <div class="form-group">

            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
            <label>CORPORATE DESCRIPTION</label>
            {!! Form::textarea('corporate_desc', $supplier->corporate_desc ?? null, ['id' => 'corporate_description', 'class' => 'form-control', 'placeholder' => 'CORPORATE DESCRIPTION', 'rows' => '5', 'cols' => '5']) !!}
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>SKYPE ID </label>
            {!! Form::text('skype_id', $supplier->skype_id ?? null, ['id' => 'skype_id' ,'class' => 'form-control', 'placeholder' => 'SKYPE ID']) !!}
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>WITH FUEL / WITHOUT FUEL </label>
            {!! Form::select('fuel_info', array('WITH FUEL' => 'WITH FUEL', 'WITHOUT FUEL' => 'WITHOUT FUEL'), $supplier->fuel_info ?? null, ['id' => 'fuel_info', 'class' => 'form-control', 'placeholder' => 'SELECT FUEL INFO']) !!}
            {!! Form::hidden('fuel_info_', $supplier->fuel_info ?? null, ['id' => 'selected_fuel']) !!}
            <div class="invalid-feedback">
            </div>
        </div>
    </div>
</div>
  <div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>OPERATION HRS FROM </label>
            <div class="bootstrap-timepicker">
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::text('operating_hrs_from', $supplier->operating_hrs_from ?? null, ['id' => 'operating_hrs_from' ,'class' => 'form-control timepicker']) !!}
                        <div class="input-group-addon">
                            <i class="fa fa-clock-o"></i>
                        </div>
                        <div class="invalid-feedback">
                        </div>
                    </div>
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
                    {!! Form::text('operating_hrs_to', $supplier->operating_hrs_to ?? null, ['id' => 'operating_hrs_to', 'class' => 'form-control timepicker']) !!}
                    <div class="input-group-addon">
                        <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="invalid-feedback">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="row mb-10">


            <div class="col-sm-12">
@php
if(isset($supplier)){
    $weekdays = $supplier->operating_weekdays;
}
@endphp
@php
$operatingWeekdays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
@endphp
<div class="col-sm-12">
@foreach ($operatingWeekdays as $key => $operationWeek)
    @php
        $checkOprationWeekYes = 'checked';
        $checkOprationWeekNo = '';
    @endphp
    @isset($supplier)
        @php
            if ($weekdays != null) {
                if (isset($weekdays[$operationWeek]) && $weekdays[$operationWeek] == 'yes') {
                    $checkOprationWeekYes = 'checked';
                }
                if (isset($weekdays[$operationWeek]) && $weekdays[$operationWeek] == 'no') {
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
                id="week_{{ $operationWeek }}_1" class="with-gap form-control radio-col-primary" value="yes"
                {{ $checkOprationWeekYes }}>
            <label for="week_{{ $operationWeek }}_1">Yes </label>
            <input name="operating_weekdays[{{ $operationWeek }}]" type="radio"
                id="week_{{ $operationWeek }}_2" class="with-gap form-control radio-col-primary" value="no"
                {{ $checkOprationWeekNo }}>
            <label for="week_{{ $operationWeek }}_2">No</label>
        </div>
        <div class="invalid-feedback">
        </div>
        @error('operating_weekdays')
            <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
@endforeach
</div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>




</div>
<div class="row mb-10">


    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="img_group">
            <label>CERTIFICATE OF CORPORATION <span class="asterisk">*</span></label>
            <div class="box1">
                <input class="hide validate" type="file" id="upload_certificate"
                    accept="image/png,image/jpg,image/jpeg"
                    name="supplier_certificate_corp"
                    onchange="previewFile('certificate')">

                <button type="button"
                    onclick="document.getElementById('upload_certificate').click()"
                    id="upload_0" class="btn red btn-outline btn-circle">+

                </button>
            </div>
            <br>
            @error('supplier_certificate_corp')
                <p class="text-danger">{{$message}}</p>
            @enderror
            @if (isset($supplier))
                @php
                    $style = 'display:block';
                @endphp
            @else
                @php
                    $style = 'display:none';
                @endphp
            @endif
            <!-- ngRepeat: (itemindex,item) in temp_loop.enquiry_comment_attachment track by $index -->
            @if (isset($supplier))
                {!! Form::hidden('supplier_certificate_corp_old', $supplier->certificate_corp ?? null, ['id' => 'img_value']) !!}
                <img id="certificate_preview" src='{{ asset("assets/uploads/supplier_certificates") }}/{{$supplier->certificate_corp}}' height="200"
                alt="CERTIFICATE Preview..." style={{$style}} value = {{$supplier->certificate_corp}}>
            @else
                <img id="certificate_preview" src="" height="200"
                alt="CERTIFICATE Preview..." style={{$style}}>
            @endif
        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="img_group">
            <label>LOGO<span class="asterisk">*</span></label>
            <div class="box1">
                <input class="hide validate" type="file" id="upload_logo"
                    accept="image/png,image/jpg,image/jpeg"
                    name="supplier_logo" onchange="previewFile('supplier_logo')">

                <button type="button"
                    onclick="document.getElementById('upload_logo').click()"
                    id="upload_1" class="btn red btn-outline btn-circle">+

                </button>
            </div>
            <br>
            @error('supplier_logo')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <!-- ngRepeat: (itemindex,item) in temp_loop.enquiry_comment_attachment track by $index -->
            @if (isset($supplier))
                {!! Form::hidden('supplier_logo_old', $supplier->logo ?? null, ['id' => 'logo_value']) !!}
                <img id="logo_preview" src="{{asset("assets/uploads/supplier_logos")}}/{{$supplier->logo}}" height="200" alt="LOGO Preview..."
                style="display:block">
            @else
            <img id="logo_preview" src="" height="200" alt="LOGO Preview..."
            style="display:none">
            @endif
        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">


            <div class="form-group">
                <label>SUPPLIER CURRENCY <span class="asterisk">*</span></label>
                {!! Form::select('opr_currency[]',$currency->pluck('full_name','id'), $supplier->opr_currency ?? null, ['id' => 'supplier_opr_currency', 'class' => 'form-control select2 validate', 'multiple' => 'multiple' ,'style'=>' "width: 100%;, "tabindex" => "-1"', 'aria-hidden' => 'true']) !!}
            </div>
            @error('opr_currency')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <div class="invalid-feedback">
            </div>
        </div>
    </div>


    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>SUPPLIER COUNTRY OF OPERATION <span class="asterisk">*</span></label>
            {!! Form::select('opr_countries[]', $countries->pluck('country_name', 'id'), $supplier->opr_countries ?? null, ['id' => 'supplier_opr_countries', 'class' => 'form-control validate select2' ,'style' => 'width: 100%', 'tabindex' => '-1', 'aria-hidden' => 'true' ,'multiple' => 'multiple']) !!}
        </div>
    @error('opr_countries')
        <p class="text-danger">{{$message}}</p>
    @enderror
    <div class="invalid-feedback">
    </div>
    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label style="display:block">BLACKOUT DAYS :
                {{-- <input type="text" placeholder="BLACKOUT DATES" class="form-control pull-right datepicker blackout_days" id="blackout_days" name="blackout_days" value="{{$supplier->blackout_dates}}" autocomplete="off"> --}}
                {!! Form::text('blackout_dates', $supplier->blackout_dates ?? null, ['id' => 'blackout_days', 'class' => 'form-control blackout_datepicker', 'readonly' => 'readonly','autocomplete' => 'off']) !!}
                <div id="datepicker"></div>
                <div class="invalid-feedback">
                </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    @if (!isset($supplier))
        <div class="col-sm-12">
            <div class="box-header with-border"
                style="padding: 10px;border-color: #c3c3c3;">

            </div>
            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                <i class="fa fa-plus-circle"></i> SERVICE BANK DETAIL </h4>

        </div>
    @endif
</div>

<div class="row mb-10">
    @if (isset($supplier))

    @else

        <div class="col-sm-12 ">
            @include('common.banks._form-inputs')
        </div>

    @endif
</div>

<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    @if (!isset($supplier))
        <div class="col-sm-12">
            <div class="box-header with-border"
                style="padding: 10px;border-color: #c3c3c3;">

            </div>
            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                <i class="fa fa-plus-circle"></i> SERVICE TYPE DETAIL </h4>

        </div>
    @endif
</div>




<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6">
                <div class="form-group">
                    <div class="form-group">
                        @if (isset($supplier))
                        @else
                            <label>SERVICE TYPE <span class="asterisk">*</span></label>
                            {!! Form::select('service_type[]', $ourServices, null, ["class" => "form-control validate select2","style" => "width: 100%;",'tabindex' => '-1', 'aria-hidden' => 'true','multiple'=>'multiple','id' =>'service_type']) !!}
                        @endif
                        <div class="invalid-feedback">
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        <!-- </div> -->

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
    @if (!isset($supplier))
        <div class="col-sm-12">
            <div class="box-header with-border"
                style="padding: 10px;border-color: #c3c3c3;">

            </div>
            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                <i class="fa fa-plus-circle"></i> CONTACT PERSON </h4>

        </div>
    @endif
</div>
<!--   <button type="button" class="btn btn-rounded btn-primary mr-10"
    data-toggle="collapse" data-target="#demo2">Add
    PROMOTION DETAIL
</button> -->
<div class="row mb-10">
    @if (isset($supplier))
    @else
        @include('common.contacts._form-inputs')
    @endif
</div>

<div class="row mb-10">
    <div class="col-md-12">
        <div class="box-header with-border"
            style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
            <button type="submit" id="create_supplier"
                class="btn btn-rounded btn-primary mr-10">{{$button}}</button>
            <button type="button" id="discard_supplier"
                class="btn btn-rounded btn-primary">Discard</button>
        </div>
    </div>
</div>

{!! Form::close() !!}




@push('scripts')
    <script>
        function previewFile(data) {
        if (data == "supplier_logo") {
            var preview = document.getElementById('logo_preview');
            var file = document.querySelector('input[name="supplier_logo"]').files[0];
        } else {
            var preview = document.getElementById('certificate_preview');
            var file = document.querySelector('input[name="supplier_certificate_corp"]').files[0];
        }
        var reader = new FileReader();
        reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display = "block";
        }
        if (file) {
        reader.readAsDataURL(file);
        } else {
        preview.src = "";
        }
    }
    $(document).on('submit','#create_supplier',function () {
        alert('test')
    });

    $(document).on('keyup','#confirmPassword',function () {
      confirmPassword($(this));
    });

    $(document).ready(function ()
    {
        // getcity()
        $(document).on('input','#contact_number', function (event) {
            this.value = this.value.replace(/[^0-9]+/g, '');
        });
              //Initialize Select2 Elements
        $('.select2').select2();
        $('#supplier_opr_currency').select2({
            "placeholder": "SELECT CURRENCY",
        });
        $('#supplier_opr_countries').select2({
            "placeholder": "SELECT COUNTRY",
        });
        $('#service_type').select2({
            "placeholder": "SELECT SERVICE TYPE",
        });
        $('.timepicker').timepicker({
            showInputs: false,
            interval: 5,
            timeFormat: 'HH:mm:ss',
        })
        var date = new Date();
        date.setDate(date.getDate())
        //Passport validity Date picke
        $('#datepicker').datepicker({
        multidate: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        }).on('changeDate', function (e) {
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
    $("#supplier_country").on("change", function () {
        if ($(this).val() != "0") {
            $("#city_div").show();
        }
    });
    $("#discard_supplier").on("click", function ()
    {
        window.history.back();
    });

    $(document).on("submit", "#register_supplier_form", function (e)
    {
        e.preventDefault();
        if(Validate()){
            confirmPassword($('#confirmPassword'));
            ajaxFormSubmit($(this));
        }
    });
    function confirmPassword(confirmAttr){
      let password         = $('#password').val();
      let confirmPassword  = confirmAttr.val();
      console.log(password, confirmPassword);
      if(password !== confirmPassword) {
          confirmAttr.css('border','red 1px solid');
          $('#create_supplier').prop('disabled',true);
          if (confirmAttr.next().length == 0) {
              confirmAttr.after("<small class='confirm_has_error'>Confirm Password Didn't Match With Password</small>");
          }
      } else {
          confirmAttr.css('border','1px solid #ced4da');
          $('#create_supplier').prop('disabled',false);
          if (confirmAttr.next().length != 0) {
              confirmAttr.next().remove('.confirm_has_error');
          }
      }
    }

</script>
@endpush
