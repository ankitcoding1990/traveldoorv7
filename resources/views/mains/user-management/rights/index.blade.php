@extends('layouts.main')


@section('title', 'User Rights')

@section('main')
  <div class="row">
    <div class="col-12">
      <div class="box">
        {{-- <div class="box-header with-border">
          <h4 class="box-title">User/Partner Rights</h4>
        </div> --}}
        <div class="box-body">
          {!! Form::open(['route' => 'user-rights.store', 'method' => 'post','onsubmit="ajaxFormSubmit($(this), false)"']) !!}
          <div class="row">
            <div class="col-md-4">
              <div class="form-group" id="sponser_div" style="display:block;">
                <label class="textfield_error" id="role_type_error">&nbsp;</label>
                {!! Form::select('user_role', userRoles(), null, ['class' => 'form-control select2 ', 'id' => 'role_type', 'placeholder' => 'Select A Role']) !!}
              </div>
            </div>
            <div class="col-md-4" id="">
              <div class="form-group">
                <label class="textfield_error">&nbsp;</label>
                <div id="roleUsersHTML">
                  {!! Form::select('user_id', $users->pluck('name', 'id'), null, ['class' => 'form-control select2','placeholder' => 'Select A User']) !!}
                </div>

              </div>
            </div>
          </div>
          <?php
          $inputcount = 1;
          ?>


        <div id="userRightsView" class="mt-4 border-top py-4">

        </div>

      {!! Form::close() !!}
    </div>

  </div>

</div>

</div>
@endsection


@push('scripts')

  <script type="text/javascript">
  // new
  $(function(){
    // role_type
    $('#role_type').change(function(){
      changeRoleGetUsers($('#role_type').val());
    });

    // select2
    $('.select-multiple').select2({
      placeholder: "--Select--",
      allowClear: true
    });
    $('.select2').select2({
      allowClear: true
    });

    $(document).on('click', '#parentMenuToggle', function(){
      let menuList = $(this).parents('.menu-row').find('.menu-list');
      if($(this).hasClass('plus')){
        $(this).addClass('minus').removeClass('plus');
        $(this).children('i').addClass('fa-minus-square-o').removeClass('fa-plus-square-o');
        menuList.removeClass('d-none');
      }else{
        $(this).addClass('plus').removeClass('minus');
        $(this).children('i').addClass('fa-plus-square-o').removeClass('fa-minus-square-o');
        menuList.addClass('d-none');
      }
    });
  });

  function fullRight(fRight){
    if(fRight.is(':checked')){
      fRight.parents('.menu-item').find('input[type="checkbox"]').prop('checked', true);
      fRight.parents('.menu-item').find('select > option').prop("selected", true).trigger('change');
    }else{
      fRight.parents('.menu-item').find('input[type="checkbox"]').prop('checked', false);
      fRight.parents('.menu-item').find('select').val('').trigger('change');
    }
    fRight.parents('.menu-item').find('.menu-item-check-admin').trigger('change');
  }
  function checkAdminRoles(isAdmin){
    let adminSelectAction = isAdmin.parents('.menu-item').find('.select-admin-actions');
    if(isAdmin.is(':checked')){
      adminSelectAction.removeClass('d-none');
      $('.select-multiple').select2({
        placeholder: "--Select--",
        allowClear: true
      });
    }else{
      adminSelectAction.addClass('d-none');
      isAdmin.parents('.menu-item').find('select').val('').trigger('change')
    }
  }
  $(document).on("change","select[name='user_id']",function()
  {
    // loader();
    $.ajax({
      type : 'post',
      url : '{{ route('user-rights.render.html') }}',
      data : {
        _token : csrfToken(),
        user_id : $(this).val(),
      },
      success : function(res){
        if(res.status == true){
          
          $('.select2').select2();
          // multiple
          $('.select-multiple').select2({
            placeholder: "--Select--",
            allowClear: true
          });
        }
        $('#userRightsView').html(res.html);
        $('.menu-item-check-admin:checked').each(function(){
          checkAdminRoles($(this));
        });
        $('.menu-full-access:checked').each(function(){
          fullRight($(this));
        });

        loader(false);
      }
    });
  });

</script>

@endpush
