<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>AGENT NAME <span class="asterisk">*</span></label>
            {{-- <input type="text" class="form-control" placeholder="AGENT NAME "
                name="agent_name" id="agent_name"> --}}
            {!!Form::text('agent_name', null, ['class' => 'form-control', 'placeholder' => 'Agent Name', 'id' => 'agent_name'])!!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>

<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>COMPANY NAME <span class="asterisk">*</span></label>
            {{-- <input type="text" class="form-control" placeholder="COMPANY NAME "
                name="company_name" id="company_name"> --}}
            {!!Form::text('company_name', null, ['class' => 'form-control', 'placeholder' => 'Company Name', 'id' => 'company_name'])!!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>EMAIL ID <span class="asterisk">*</span></label>
            {{-- <input type="text" class="form-control" placeholder="EMAIL ID"
                name="email_id" id="email_id"> --}}
            {!!Form::email('email_id', $agent->company_email ?? '', ['class' => 'form-control', 'placeholder' => 'Email ID', 'id' => 'email_id'])!!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CONTACT NUMBER <span class="asterisk">*</span></label>
              <input type="text" class="form-control input-lg"
                    {{-- id="contact_number" name="contact_number" autocomplete="off"
                    placeholder="Enter Mobile Number"> --}}
              {!!Form::text('contact_number', $agent->company_contact ?? '', ['class' => 'form-control', 'placeholder' => 'Enter Mobile Number', 'id' => 'contact_number', 'autocomplete' => 'off'])!!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>




</div>
<div class="row mb-10" style="display: none">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>FAX NUMBER <span class="asterisk">*</span></label>
            {{-- <input type="text" class="form-control" placeholder="FAX NUMBER"
                name="fax_number" id="fax_number"> --}}
              {!!Form::text('fax_number', null, ['class' => 'form-control', 'placeholder' => 'FAX NUMBER', 'id' => 'fax_number', 'autocomplete' => 'off'])!!}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>Agent Reference ID <span class="asterisk">*</span></label>
            {{-- @dd($users);
            @dd($users->pluck('full_name', 'id')) --}}
           <!--  <input type="text" class="form-control"
                placeholder="Agent Reference ID" name="agent_reference_id"
                id="agent_reference_id"> -->
                {!!Form::select('agent_reference_id', $users->pluck('full_name','users_id'), $agent->agent_ref_id ?? null, ['class' => 'form-control','id' => 'agent_reference_id'])!!}
                {{-- <select name="agent_reference_id" id="agent_reference_id" class="form-control">
                    <option value="">-- Select User/Operator --</option>
                    @foreach($users as $user)
                    <option value="{{$user->users_id}}">{{$user->full_name}}</option>
                    @endforeach
                </select> --}}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>ADDRESS LINE 1 <span class="asterisk">*</span></label>
            {!! Form::textarea('address', null, ['class' => 'form-control', 'placeholder' => 'ADDRESS', 'id' => 'address', 'rows' => 5, 'cols' => 5]) !!}
            {{-- <textarea rows="5" cols="5" class="form-control"
                placeholder="ADDRESS" name="address" id="address"></textarea> --}}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <div class="form-group">

                <div class="form-group">
                  <label>COUNTRY <span class="asterisk">*</span></label>
                    {!! Form::select('agent_country', $countries->pluck('country_name', 'country_id'), null, ['class' => 'form-control select2', 'id' => 'agent_country', 'placeholder' => 'Select Country']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

</div>
<div class="row mb-10" id="city_div" style="display:{{ isset($cities) && $cities->count() ? 'block' : 'none' }}">

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <div class="form-group">
              <div class="form-group">
                    <label for="agent_city">CITY <span class="asterisk">*</span></label>
                    <select id="agent_city" name="agent_city" class="form-control select2" style="width: 100%;">
                    <option selected="selected"  value="0" hidden>SELECT CITY</option>
                    @isset($agent)
                      @foreach ($cities as $key => $city)

                          <option selected="{{ $city->id == @$agent->agent_city }}"  value="{{ $city->id }}" hidden>{{ $city->name }}</option>
                      @endforeach
                    @endisset

                  </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

</div>
<div class="row mb-10" >
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CORPORATE REG. NO </label>

            {!!Form::text('corporate_reg_no',null , ['class' => 'form-control', 'placeholder' => 'CORPORATE REG NO', 'id' => 'corporate_reg_no'])!!}
            {{-- <input type="text" class="form-control"
                placeholder="CORPORATE REG NO" name="corporate_reg_no"
                id="corporate_reg_no"> --}}
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10" style="display: none">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>CORPORATE DESCRIPTION <span class="asterisk">*</span></label>
            <textarea rows="5" cols="5" class="form-control"
                placeholder="CORPORATE DESCRIPTION "
                name="corporate_description"
                id="corporate_description"></textarea>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>
</div>
<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">
            <label>SKYPE ID </label>
            {!! Form::text('skype_id', null, ['id' => 'skype_id', 'class' => 'form-control', 'placeholder' => 'SKYPE ID']) !!}

        </div>
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
</div>
<div class="col-sm-12 col-md-12 col-lg-6">
</div>
<div class="row mb-10">
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
    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="row mb-10">
          @php
            $operatingWeekdays = [
              'monday',
              'tuesday',
              'wednesday',
              'thursday',
              'friday',
              'saturday',
              'sunday'
            ];
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
                          <input name="week_{{ $operationWeek }}" type="radio"
                              id="week_{{$operationWeek}}_1"
                              class="with-gap radio-col-primary" value="yes" {{ $checkOprationWeekYes }}>
                          <label for="week_{{$operationWeek}}_1">Yes </label>
                          <input name="week_{{$operationWeek}}" type="radio"
                              id="week_{{$operationWeek}}_2"
                              class="with-gap radio-col-primary" value="no" {{ $checkOprationWeekNo }}>
                          <label for="week_{{$operationWeek}}_2">No</label>
                      </div>
                  </div>
                @endforeach
                {{-- <div class="row">
                    <div class="col-md-6">
                        <label>MONDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input name="week_monday" type="radio"
                            id="week_monday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_monday_1">Yes </label>
                        <input name="week_monday" type="radio"
                            id="week_monday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_monday_2">No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>TUESDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input name="week_tuesday" type="radio"
                            id="week_tuesday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_tuesday_1">Yes </label>
                        <input name="week_tuesday" type="radio"
                            id="week_tuesday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_tuesday_2">No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>WEDNESDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input name="week_wednesday" type="radio"
                            id="week_wednesday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_wednesday_1">Yes </label>
                        <input name="week_wednesday" type="radio"
                            id="week_wednesday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_wednesday_2">No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>THURSDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input name="week_thursday" type="radio"
                            id="week_thursday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_thursday_1">Yes </label>
                        <input name="week_thursday" type="radio"
                            id="week_thursday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_thursday_2">No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>FRIDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input name="week_friday" type="radio"
                            id="week_friday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_friday_1">Yes </label>
                        <input name="week_friday" type="radio"
                            id="week_friday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_friday_2">No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>SATURDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">
                        <input name="week_saturday" type="radio"
                            id="week_saturday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_saturday_1">Yes </label>
                        <input name="week_saturday" type="radio"
                            id="week_saturday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_saturday_2">No</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>SUNDAY <span class="asterisk">*</span></label>
                    </div>
                    <div class="col-md-6">

                        <input name="week_sunday" type="radio"
                            id="week_sunday_1"
                            class="with-gap radio-col-primary" value="yes">
                        <label for="week_sunday_1">Yes </label>
                        <input name="week_sunday" type="radio"
                            id="week_sunday_2"
                            class="with-gap radio-col-primary" value="no">
                        <label for="week_sunday_2">No</label>
                    </div>
                </div> --}}


            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>




</div>
<div class="row mb-10">

<div class="col-sm-12 col-md-12 col-lg-6">
        <div class="img_group">
            <label>CERTIFICATE OF CORPORATION </label>
            <div class="box1">
                <input class="hide" type="file" id="upload_certificate"
                    accept="image/png,image/jpg,image/jpeg"
                    name="agent_certificate_file"
                    onchange="previewFile('certificate')">

                <button type="button"
                    onclick="document.getElementById('upload_certificate').click()"
                    id="upload_0" class="btn red btn-outline btn-circle">+

                </button>
            </div>
            <br>
            <!-- ngRepeat: (itemindex,item) in temp_loop.enquiry_comment_attachment track by $index -->
            @isset($agent)
              @if(!empty($agent['certificate_corp']))
               <img id="certificate_preview" height="200" alt="CERTIFICATE Preview..." src="{{ asset('assets/uploads/agent_certificates/')}}/{{$agent['certificate_corp']}}">
               @else
                <img id="certificate_preview" src="" height="200"
                    alt="CERTIFICATE Preview..." style="display:none">
               @endif
            @endisset

        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">
    </div>
</div>
<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="img_group">
            <label>LOGO</label>
            <div class="box1">
                <input class="hide" type="file" id="upload_logo"
                    accept="image/png,image/jpg,image/jpeg"
                    name="agent_logo_file" onchange="previewFile('logo')">

                <button type="button"
                    onclick="document.getElementById('upload_logo').click()"
                    id="upload_0" class="btn red btn-outline btn-circle">+

                </button>
            </div>
            <br>

            <!-- ngRepeat: (itemindex,item) in temp_loop.enquiry_comment_attachment track by $index -->
            @isset($agent)
              @if($agent['agent_logo']!="")
              <img id="logo_preview" height="200" alt="LOGO Preview..." src="{{ asset('assets/uploads/agent_logos/')}}/{{$agent['agent_logo']}}">
              @else
                <img id="logo_preview" height="200" alt="LOGO Preview..." src="">
               @endif
            @endisset

            {{-- <img id="logo_preview" src="" height="200" alt="LOGO Preview..."
                style="display:none"> --}}
        </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>


    <div class="col-sm-12 col-md-12 col-lg-6">



            <div class="form-group">
                <label>AGENT CURRENCY <span class="asterisk">*</span></label>
                <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="agent_opr_currency"
                    name="agent_opr_currency[]" multiple="multiple">

                    @foreach($currency as $curr)
                      @php
                        $agentCurrencyCode = '';
                      @endphp
                      @isset($agent)
                          @php
                            $operating_currencies=explode(',',$agent['agent_opr_currency']);
                          @endphp
                          @if (in_array($curr->code,$operating_currencies))
                            @php
                              $agentCurrencyCode = 'selected';
                            @endphp
                          @endif
                      @endisset
                    <option value="{{$curr->code}}" {{ $agentCurrencyCode }}>{{$curr->code}}
                        ({{$curr->name}})</option>

                    @endforeach
                </select>

            </div>

    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

    <div class="col-sm-12 col-md-12 col-lg-6">
        <div class="form-group">


            <div class="form-group">

                <label>AGENT COUNTRY OF OPERATION <span
                        class="asterisk">*</span></label>
                <select class="form-control select2 " style="width: 100%;"
                    tabindex="-1" aria-hidden="true" id="agent_opr_countries"
                    name="agent_opr_countries[]">
                    <option value="0" hidden>SELECT COUNTRY</option>
                    @foreach($countries_operation as $country)
                      @php
                        $agent_opr_countries_selected = '';
                      @endphp
                      @isset($agent)
                        @php
                        if ($agent->agent_opr_countries == $country->country_id) {
                            $agent_opr_countries_selected = 'selected';
                        }
                        @endphp
                      @endisset
                      <option value="{{$country->country_id}}" {{ $agent_opr_countries_selected }}>{{$country->country_name}}</option>

                    @endforeach
                </select>
            </div>

        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

    <div class="col-sm-12">
        <div class="box-header with-border"
            style="padding: 10px;border-color: #c3c3c3;">

        </div>
        <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
            <i class="fa fa-plus-circle"></i> SERVICE BANK DETAIL </h4>

    </div>

</div>
<!--   <button type="button" class="btn btn-rounded btn-primary mr-10"
    data-toggle="collapse" data-target="#demo">Add
    Service Bank Detail</button> -->

<div class="row mb-10">
    <div class="col-sm-12 ">
       <!--  <div id="demo" class="collapse"> -->
       @if (isset($agent))
         {{-- edit agent bank detail --}}
         @php
           $agent_bank_details = unserialize($agent['agent_bank_details']);
         @endphp
         <div class="row mb-10">
               @php
                 $agent_bank_details=unserialize($agent['agent_bank_details']);
                 for($bank_count=0;$bank_count< count($agent_bank_details);$bank_count++)
                 {
             @endphp
             <div class="col-md-6 bank_div" id="bank_div_{{($bank_count+1)}}">
                <div class="col-sm-12 ">
                 <div class="form-group">
                     <label>ACCOUNT NUMBER <span class="asterisk">*</span></label>
                     <input type="text" class="form-control" placeholder="ACCOUNT NUMBER" id="account_number_{{($bank_count+1)}}" name="account_number[]" value="{{$agent_bank_details[$bank_count]['account_number']}}">
                 </div>
             </div>

             <div class="col-sm-12 col-md-12">
                 <div class="form-group">
                     <label>BANK NAME <span class="asterisk">*</span></label>
                     <input type="text" class="form-control" placeholder="BANK NAME" id="bank_name_{{($bank_count+1)}}" name="bank_name[]"value="{{$agent_bank_details[$bank_count]['bank_name']}}">
                 </div>
             </div>
             <div class="col-sm-12 col-md-12">
                 <div class="form-group">
                     <label>BANK IFSC CODE <span class="asterisk">*</span></label>
                     <input type="text" class="form-control" placeholder="BANK IFSC CODE"  id="bank_ifsc_{{($bank_count+1)}}" name="bank_ifsc[]" value="{{$agent_bank_details[$bank_count]['bank_ifsc']}}">
                 </div>
             </div>

             <div class="col-sm-12 col-md-12">
                 <div class="form-group">
                     <label>BANK IBAN CODE <span class="asterisk">*</span></label>
                     <input type="text" class="form-control" placeholder="BANK IBAN CODE" id="bank_iban_{{($bank_count+1)}}" name="bank_iban[]" value="{{$agent_bank_details[$bank_count]['bank_iban']}}">
                 </div>
             </div>
                 <div class="col-sm-12 col-md-12">
                 <div class="form-group">
                     <div class="form-group">
                         <label>CURRENCY <span class="asterisk">*</span></label>
                         <select class="form-control" style="width: 100%;"
                             tabindex="-1" aria-hidden="true" id="bank_currency_{{($bank_count+1)}}" name="bank_currency[]">
                             <option selected="selected" value="0">Select Currency</option>
                            @foreach($currency as $curr)
                             @if($agent_bank_details[$bank_count]['bank_currency']==$curr->code)
                             <option value="{{$curr->code}}" selected="selected">{{$curr->code}} ({{$curr->name}})</option>
                             @else
                               <option value="{{$curr->code}}">{{$curr->code}} ({{$curr->name}})</option>
                             @endif

                             @endforeach
                         </select>
                     </div>

                 </div>
                 <div class="col-sm-6 col-md-12" style="display: flex;justify-content: flex-end;">
                     <!-- <img class="plus-icon" style="display: block;" src="{{ asset('assets/images/minus_icon.png') }}"> -->
                      @if($bank_count==0)
                     <img id="add_more_bank1" class="plus-icon add_more_bank" style="display: block;" src="{{ asset('assets/images/add_icon.png') }}">
                     @else
                      <img id="remove_more_bank1" class="minus-icon remove_more_bank" style="display: block;" src="{{ asset('assets/images/minus_icon.png') }}">
                     @endif
                 </div>
             </div>
         </div>

         @php
             }
         @endphp
         </div>

         {{-- /edit agent bank detail --}}


      @else
           {{-- new Agent --}}
           <div class="row">
               <div class="col-md-6 bank_div" id="bank_div_1"
                   style="padding:0">

                   <div class="col-sm-12 col-md-12 mt-20">
                       <div class="form-group">
                           <label>ACCOUNT NUMBER <span
                                   class="asterisk">*</span></label>
                           <input type="text" class="form-control"
                               placeholder="ACCOUNT NUMBER"
                               id="account_number_1" name="account_number[]">
                       </div>
                   </div>

                   <div class="col-sm-12 col-md-12">
                       <div class="form-group">
                           <label>BANK NAME <span
                                   class="asterisk">*</span></label>
                           <input type="text" class="form-control"
                               placeholder="BANK NAME" id="bank_name_1"
                               name="bank_name[]">
                       </div>
                   </div>
                   <div class="col-sm-12 col-md-12">
                       <div class="form-group">
                           <label>BANK IFSC CODE <span
                                   class="asterisk">*</span></label>
                           <input type="text" class="form-control"
                               placeholder="BANK IFSC CODE" id="bank_ifsc_1"
                               name="bank_ifsc[]">
                       </div>
                   </div>

                   <div class="col-sm-12 col-md-12">
                       <div class="form-group">
                           <label>BANK IBAN CODE <span
                                   class="asterisk">*</span></label>
                           <input type="text" class="form-control"
                               placeholder="BANK IBAN CODE" id="bank_iban_1"
                               name="bank_iban[]">
                       </div>
                   </div>
                   <div class="col-sm-12 col-md-12">
                       <div class="form-group">
                           <div class="form-group">
                               <label>CURRENCY <span
                                       class="asterisk">*</span></label>
                               <select class="form-control"
                                   style="width: 100%;" tabindex="-1"
                                   aria-hidden="true" id="bank_currency_1"
                                   name="bank_currency[]">
                                   <option selected="selected" value="0">Select
                                       Currency</option>
                                   @foreach($currency as $curr)

                                   <option value="{{$curr->code}}">
                                       {{$curr->code}} ({{$curr->name}})
                                   </option>

                                   @endforeach
                               </select>
                           </div>

                       </div>
                       <div class="col-sm-6 col-md-12"
                           style="display: flex;justify-content: flex-end;">
                           <!-- <img class="plus-icon" style="display: block;" src="{{ asset('assets/images/minus_icon.png') }}"> -->
                           <img id="add_more_bank1"
                               class="plus-icon add_more_bank"
                               style="display: block;"
                               src="{{ asset('assets/images/add_icon.png') }}">

                       </div>
                   </div>

               </div>

           </div>
           {{-- /new agent --}}
       @endif


       <!--  </div> -->
    </div>

</div>
<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6">

    </div>

    <div class="col-sm-12">
        <div class="box-header with-border"
            style="padding: 10px;border-color: #c3c3c3;">

        </div>
        <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
            <i class="fa fa-plus-circle"></i> SERVICE TYPE DETAIL </h4>

    </div>
</div>




<div class="row mb-10">

    <div class="col-sm-12 col-md-12 col-lg-6">
      @php
        $service_types = [
          'hotel' =>  'Hotel',
          'activity'  => 'Activity',
          'guide' =>  'Activity',
          'sightseeing' =>  'Sightseeing',
          'itinerary' =>  'Package',
          'transfer'  =>  'Transfer',
          'restaurant'  =>  'Restaurant'
        ];
      @endphp
      <div class="form-group">
        <label>SERVICE TYPE <span class="asterisk">*</span></label>
        <select class="form-control" style="width: 100%;"
            tabindex="-1" aria-hidden="true" multiple="multiple"
            name="service_type[]" id="service_type">
            {{-- <option value="hotel">Hotel</option>
            <option value="activity">Activity</option>
            <!-- removed <option value="transportation">Transportation
            </option> -->
            <option value="guide">Guide</option>
             <option value="sightseeing">Sightseeing</option>
              <option value="itinerary">Package</option>
             <option value="transfer">Transfer</option>
            <option value="restaurant">Restaurant</option> --}}

            @foreach ($service_types as $service_type_key => $service_type_value)
              @php
                $service_type_checked = false;
              @endphp
              @isset($agent)
                @php
                  $service_type = explode(',',$agent['agent_service_type']);
                  if (in_array($service_type_key,$service_type)) {
                      $service_type_checked = 'selected';
                  }
                @endphp

              @endisset

                <option value="{{ $service_type_key }}" {{ $service_type_checked }}>{{ $service_type_value }}</option>
            @endforeach
        </select>
      </div>
    </div>

    <div class="col-sm-4 col-md-4 col-lg-3">
        <br>
        <input name="select_all" type="checkbox" id="select_all">
        <label for="select_all">Select All</label>
    </div>
    <div class="col-sm-12">
      @php
      $hotel_markup="";
      $activity_markup="";
      $transportation_markup="";
      $guide_markup="";
      $sightseeing_markup="";
      $itinerary_markup="";
      $transfer_markup="";
      $restaurant_markup="";
      if (isset($agent)) {
        if($agent['agent_service_markup']!="")
        {
          $get_services=explode("///",$agent['agent_service_markup']);

          for($services=0;$services< count($get_services);$services++)
          {
            if($get_services[$services]!="")
            {
              $get_services_individual=explode("---",$get_services[$services]);
              $service_name=$get_services_individual[0]."_markup";
              $$service_name=$get_services_individual[1] ?? "";


            }
          }
        }
      }


      @endphp
        <div class='row'>
            <div class="col-md-6"
            style="padding:0">
            <div class="col-sm-12 col-md-12 mt-20">
                <div class="form-group">
                    <input type='hidden' name='service_name[]' value='hotel'>
                    <label for="">{{ strtoupper('Hotel')}}</label>
                    <input type='text' value="{{ $hotel_markup ?? '' }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 mt-20">
                <div class="form-group">
                 <input type='hidden' name='service_name[]' value='activity'>
                 <label for="">{{ strtoupper('Activity')}}</label>
                 <input type='text' value="{{ $activity_markup ?? '' }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
             </div>
         </div>
        <!--  <div class="col-sm-12 col-md-12 mt-20">
            <div class="form-group">
                <input type='hidden' name='service_name[]' value='transportation'>
                <label for="">{{ strtoupper('Transportation')}}</label>
                <input type='text' class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
            </div>
        </div> -->
        <div class="col-sm-12 col-md-12 mt-20">
            <div class="form-group">
                <input type='hidden' name='service_name[]' value='guide'>
                <label for="">{{ strtoupper('Guide')}}</label>
                <input type='text' value="{{ $guide_markup }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
            </div>
        </div>
        <div class="col-sm-12 col-md-12 mt-20">
            <div class="form-group">
               <input type='hidden'  name='service_name[]' value='sightseeing'>
               <label for="">{{ strtoupper('Sightseeing')}}</label>
               <input type='text' value="{{ $sightseeing_markup ?? '' }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
           </div>
       </div>
        <div class="col-sm-12 col-md-12 mt-20">
            <div class="form-group">
               <input type='hidden' name='service_name[]' value='itinerary'>
               <label for="">{{ strtoupper('Package')}}</label>
               <input type='text' value="{{ $itinerary_markup }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
           </div>
       </div>
       <div class="col-sm-12 col-md-12 mt-20">
            <div class="form-group">
               <input type='hidden' value="{{ $hotel_markup ?? '' }}" name='service_name[]' value='transfer'>
               <label for="">{{ strtoupper('Transfer')}}</label>
               <input type='text' value="{{ $transfer_markup ?? '' }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
           </div>
       </div>
        <div class="col-sm-12 col-md-12 mt-20">
            <div class="form-group">
               <input type='hidden' name='service_name[]' value='restaurant'>
               <label for="">{{ strtoupper('Restaurant')}}</label>
               <input type='text' value="{{ $restaurant_markup ?? '' }}" class='form-control' name='service_cost[]' placeholder="Markup in %" onkeypress='javascript:return validateNumber(event)'>
           </div>
       </div>


   </div>

</div>
</div>

    <div class="col-sm-12">
        <div class="box-header with-border"
            style="padding: 10px;border-color: #c3c3c3;">

        </div>
        <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
            <i class="fa fa-plus-circle"></i> CONTACT PERSON </h4>

    </div>

</div>
<!--   <button type="button" class="btn btn-rounded btn-primary mr-10"
    data-toggle="collapse" data-target="#demo2">Add
    PROMOTION DETAIL
</button> -->
{{-- agent content info --}}
<div class="row mb-10">
    <div class="col-md-12">

      @if (isset($agent))
        @php
           $contact_persons=unserialize($agent['contact_persons']);
        @endphp
        {{-- edit agent form --}}
        @for ($contact=0;$contact< count($contact_persons);$contact++)
          <div class="col-md-6 contact_div" id="contact_div_{{($contact+1)}}">
               <div class="col-sm-12 col-md-12">
              <div class="form-group">
                  <label>CONTACT PERSON NAME <span class="asterisk">*</span> </label>
                  <input type="text" class="form-control" placeholder="CONTACT PERSON NAME " id="contact_name_{{($contact+1)}}" name="contact_person_name[]" value="{{$contact_persons[$contact]['contact_person_name']}}">
              </div>
          </div>
           <div class="col-sm-12 col-md-12">
              <div class="form-group">

                  <div class="form-group">
                  <label>CONTACT NUMBER  <span class="asterisk">*</span></label>

                      <input type="text" class="form-control input-lg" id="contact_number_{{($contact+1)}}" name="contact_person_number[]" autocomplete="off" placeholder="CONTACT NUMBER"  value="{{$contact_persons[$contact]['contact_person_number']}}">

              </div>
              </div>
          </div>
           <div class="col-sm-12 col-md-12">
              <div class="form-group">
                  <label>EMAIL ID <span class="asterisk">*</span></label>
                  <input type="text" class="form-control" placeholder="EMAIL ID" id="contact_email_{{($contact+1)}}" name="contact_person_email[]" value="{{$contact_persons[$contact]['contact_person_email']}}">
              </div>

              <div class="col-sm-6 col-md-12" style="display: flex;justify-content: flex-end;">
                  <!-- <img class="plus-icon" style="display: block;" src="{{ asset('assets/images/minus_icon.png')}}"> -->
                  @if($contact==0)
                  <img id="add_more_contact{{($contact+1)}}" class="plus-icon add_more_contact" style="display: block;" src="{{ asset('assets/images/add_icon.png')}}">
                  @else
                  <img id="remove_more_contact{{($contact+1)}}" class="minus-icon remove_more_contact" style="display: block;" src="{{ asset('assets/images/minus_icon.png')}}">

                  @endif

              </div>
          </div>
          </div>
        @endfor
      @else
          {{-- new agent form --}}
        <!-- <div id="demo2" class="collapse"> -->
            <div class="row">
                <div class="col-md-6 contact_div" id="contact_div_1"
                    style="padding:0">
                    <div class="col-sm-12 col-md-12 mt-20">
                        <div class="form-group">
                            <label>CONTACT PERSON NAME <span
                                    class="asterisk">*</span>
                            </label>
                            <input type="text" class="form-control"
                                placeholder="CONTACT PERSON NAME "
                                id="contact_name_1"
                                name="contact_person_name[]">
                        </div>

                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">

                            <div class="form-group">
                                <label>CONTACT NUMBER <span
                                        class="asterisk">*</span></label>

                                    <input type="text"
                                        class="form-control input-lg"
                                        id="contact_number_1"
                                        name="contact_person_number[]"
                                        autocomplete="off"
                                        placeholder="CONTACT NUMBER">

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12">
                        <div class="form-group">
                            <label>EMAIL ID <span
                                    class="asterisk">*</span></label>
                            <input type="text" class="form-control"
                                placeholder="EMAIL ID" id="contact_email_1"
                                name="contact_person_email[]">
                        </div>

                        <div class="col-sm-6 col-md-12"
                            style="display: flex;justify-content: flex-end;">
                            <!-- <img class="plus-icon" style="display: block;" src="{{ asset('assets/images/minus_icon.png')}}"> -->
                            <img id="add_more_contact1"
                                class="plus-icon add_more_contact"
                                style="display: block;"
                                src="{{ asset('assets/images/add_icon.png')}}">

                        </div>
                    </div>
                </div>
            </div>

        <!-- </div> -->
      @endif

    </div>
</div>
{{-- /agent content info --}}


<div class="row mb-10">
    <div class="col-md-12">
        <div class="box-header with-border"
            style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
            @if (isset($agent))
              <input type="hidden" name="agent_id" value="<?php echo urlencode(base64_encode(base64_encode($agent['agent_id'])));?>">
              <button type="submit" id="update_agent" class="btn btn-rounded btn-primary mr-10">Update</button>
              <button type="submit" id="discard_agent" class="btn btn-rounded btn-primary">Discard</button>
            @else
              <button type="submit" id="create_agent"
                  class="btn btn-rounded btn-primary mr-10">Save</button>
              <button type="submit" id="discard_agent"
                  class="btn btn-rounded btn-primary">Discard</button>
            @endif



        </div>
    </div>
</div>
