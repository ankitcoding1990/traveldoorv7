<div class="row mb-10">
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
            <label>EMPLOYEE CODE <span class="asterisk">*</span></label>
            {!! Form::text('users_empcode', null, ['class' => 'form-control', 'id' => 'employee_code','placeholder' => 'EMPLOYEE CODE']) !!}
            <div class="invalid-feedback">

            </div>
        </div>
    </div>
    @php
      $userRoles = userRoles();
    @endphp
    <div class="col-sm-6 col-md-6">
        <div class="form-group">
          <label>SELECT ROLES <span class="asterisk">*</span></label>
            {!! Form::select('users_role', $userRoles, null, ['class' => 'form-control select2','id' => 'employee_role', 'placeholder' => 'Select Role']) !!}
            <div class="invalid-feedback">

            </div>
        </div>
    </div>
    {{-- countries --}}
    @php
      $countries = countries();
    @endphp
    <div class="col-sm-6 col-md-6" id="partner_div" style="display:none">
        <div class="form-group">
            <label>Partner's Country <span class="asterisk">*</span></label>
            {!! Form::select('users_partner_country', $countries->pluck('country_name', 'country_id'), null, ['class' => 'form-control select2', 'id' => 'partner_country', 'style="width:100%"', 'placeholder' => 'Select Country']) !!}
            <div class="invalid-feedback">

            </div>
        </div>
    </div>
    {{-- /countries --}}

    <div class="col-sm-6 col-md-6">

        <div class="form-group">
            <label>USERNAME <span class="asterisk">*</span></label>
            {!! Form::text('username', null, ['class' => 'form-control', 'id' => 'username', 'placeholder' => 'USERNAME']) !!}
            <div class="invalid-feedback">

            </div>
        </div>
    </div>

    <div class="col-sm-6 col-md-6">

        <div class="form-group">

            <label>FIRST NAME <span class="asterisk">*</span></label>
            {!! Form::text('users_fname', null, ['class' => 'form-control', 'id' => 'first_name','placeholder' => 'First Name']) !!}
            <div class="invalid-feedback">

            </div>

        </div>

    </div>

    <div class="col-sm-6 col-md-6">

        <div class="form-group">

            <label>LAST NAME <span class="asterisk">*</span></label>
            {!! Form::text('users_lname', null, ['class' => 'form-control', 'id' => 'last_name']) !!}
            <div class="invalid-feedback">

            </div>

        </div>

    </div>

    <div class="col-sm-6 col-md-6">

        <div class="form-group">

            <label>CONTACT NUMBER <span class="asterisk">*</span></label>
            {!! Form::text('users_contact', null, ['class' => 'form-control', 'id' => 'contact_number', 'maxlength' => '15', 'autocomplete' => 'off', 'placeholder' => 'CONTACT NUMBER']) !!}

            <div class="invalid-feedback">

            </div>
            <div class="intl-tel-input">


            </div>

        </div>

    </div>

    <div class="col-sm-6 col-md-6">

        <div class="form-group">

            <label>E-MAIL <span class="asterisk">*</span></label>
            {!! Form::email('email', null, ['id' => 'employee_email', 'class' => 'form-control', 'placeholder' => 'Enter email']) !!}
            <div class="invalid-feedback">

            </div>
        </div>
    </div>
</div>
@push('scripts')
  <script>
      $(document).ready(function()
      {
          $(".select2").select2();
          $("#employee_role").change(function()
          {
              enablePartnerCountry($(this).val());
          });
      });


      // enablePartnerCountry
      function enablePartnerCountry(role){
        if(role=="partner")
        {
            $("#partner_country").val('').trigger("change");
            $("#partner_div").show(200);
        }else{
             $("#partner_country").val('').trigger("change");
             $("#partner_div").hide();
        }
      }

          $(document).on("submit","#userForm",function()

          {
              event.preventDefault()
              var employee_code=$("#employee_code").val();
              var employee_role=$("#employee_role").val();
              var partner_country=$("#partner_country").val();
              var username=$("#username").val();
              var first_name=$("#first_name").val();
              var last_name=$("#last_name").val();
              var contact_number=$("#contact_number").val();
              var employee_email=$("#employee_email").val();
              var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
              // empCode
              if(employee_code.trim()==""){
                  $("#employee_code").addClass('border-error');
              }else{
                  $("#employee_code").removeClass('border-error');
              }
              // empCode
              if(employee_role.trim()=='')              {
                $("#employee_role").parent().find('.select2-selection').addClass('border-error');
              }else{
               $("#employee_role").parent().find('.select2-selection').removeClass('border-error');
              }

              if(employee_role.trim()=="partner" && partner_country.trim()=="0"){
                  $("#partner_country").parent().find('.select2-selection').addClass('border-error');
              }else{
               $("#partner_country").parent().find('.select2-selection').removeClass('border-error');
              }
              // username
              if(username.trim()==""){
                  $("#username").addClass('border-error');
              }else{
               $("#username").removeClass('border-error');
              }
              // firstName
              if(first_name.trim()==""){
                $("#first_name").css("border","1px solid #cf3c63");
              }else{
               $("#first_name").css("border","1px solid #9e9e9e");
              }
              if(last_name.trim()=="")              {
                  $("#last_name").css("border","1px solid #cf3c63");
              }else{
                $("#last_name").css("border","1px solid #9e9e9e");

              }

               if(contact_number.trim()=="")

              {

                  $("#contact_number").css("border","1px solid #cf3c63");

              }

              else

              {

               $("#contact_number").css("border","1px solid #9e9e9e");

              }

               if(employee_email.trim()=="")

              {

                  $("#employee_email").css("border","1px solid #cf3c63");

              }

              else

              {

               $("#employee_email").css("border","1px solid #9e9e9e");

              }

              if(!regex.test(employee_email.trim()) && employee_email.trim()!="")

              {

                  $("#employee_email").css("border","1px solid #cf3c63");

              }



              if(employee_code.trim()=="")

              {

                  $("#employee_code").focus();

              }

              else if(employee_role.trim()=="0")

              {

                  $("#employee_role").parent().find('.select2-selection').focus();

              }
              else if(employee_role.trim()=="Partner" && partner_country.trim()=="0")

              {

                  $("#partner_country").parent().find('.select2-selection').focus();

              }
              else if(username.trim()=="")

              {

                  $("#username").focus();

              }

               else if(first_name.trim()=="")

              {

                  $("#first_name").focus();

              }

              else if(last_name.trim()=="")

              {

                  $("#last_name").focus();

              }

              else if(contact_number.trim()=="")

              {

                  $("#contact_number").focus();

              }

              else if(employee_email.trim()=="")

              {

                  $("#employee_email").focus();

              }

              else if(!regex.test(employee_email.trim()))

              {

                  $("#employee_email").focus();

              }

              else

              {

                ajaxFormSubmit($(this))

              }
          });
  </script>
@endpush
