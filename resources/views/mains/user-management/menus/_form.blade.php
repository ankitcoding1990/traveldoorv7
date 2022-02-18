<div class="row mb-10">
  <div class="col-sm-4 col-md-4">
    <div class="form-group">
      <label>Menu Name <span class="asterisk">*</span></label>
      {!! Form::text('menu_name', null, ['id' => 'sub_menu_name', 'class' => 'form-control', 'placeholder' => 'Menu Name','autofocus']) !!}
      <div class="invalid-feedback">

       </div>
    </div>
  </div>
  <div class="col-sm-4 col-md-4">
    <div class="form-group">
      <label>Menu Route / URL <span class="asterisk">*</span></label>
      {!! Form::text('menu_file', null, ['class' => 'form-control', 'placeholder' => 'Menu Route / URL']) !!}
        <div class="invalid-feedback">

        </div>
    </div>
  </div>
  <div class="col-sm-3 col-md-3">
    <div class="checkbox mt-4">
      {!! Form::checkbox('newwindow', 1, @$menu->newwindow, ['id' => 'check']) !!}
      <label for="check">New Window</label>
    </div>
  </div>
</div>
<div class="row">


  <div class="col-sm-12 col-md-12">
    <div class="form-group">
      <label for="" class="mr-4">Has Parent Menu </label>
      <div class="checkbox mt-4">
        {!! Form::radio('has_parent', 'yes', @$menu->menu_pid != null, ['class' => 'has_parent_radio', 'id' => 'hasParentMenuYes']) !!}
        <label for="hasParentMenuYes">Yes</label>
      </div>
      <div class="checkbox mt-4">
        @php
          $has_parent_no =  true;
          if (isset($menu) && $menu->menu_pid != null) {
              $has_parent_no =  false;
          }
        @endphp
        {!! Form::radio('has_parent', 'no', $has_parent_no, ['class' => 'has_parent_radio', 'id' => 'hasParentMenuNo']) !!}
        <label for="hasParentMenuNo">No</label>
      </div>
    </div>
    <div class="invalid-feedback">

    </div>


  </div>
  @php
    $parentMenus = getActiveParentMenus();
  @endphp
  <div class="col-sm-6 col-md-6" id="parentMenu">
    <div class="form-group">
      <label>Parent Menu <span class="asterisk">*</span></label>
      {!! Form::select('menu_pid', $parentMenus->pluck('menu_name', 'id'), null, ['id' => 'menu_pid','class' => 'form-control select2', 'placeholder' => 'Select Parent Menus', 'style="width:100%"']) !!}
      <div class="invalid-feedback">

      </div>
    </div>
  </div>
</div>





@push('scripts')
  <script>

    $(document).ready(function(){
      $('.has_parent_radio').change(function(){
        hasParentOptions();
      });
      function hasParentOptions(){
        let has_parent = $('.has_parent_radio:checked').val()
        if (has_parent == 'yes') {
          $('#parentMenu').show(400);
        }else{
          $('#parentMenu').hide(200);
          $('#parentMenu select').val('');
        }
      }
      hasParentOptions();
    });
          // $(document).on("click","#save_main_menu",function()
          // {
          //     var menu_name=$("#menu_name").val();
          //
          //     var file_name=$("#file_name").val();
          //
          //
          //
          //     if(menu_name.trim()=="")
          //
          //     {
          //
          //         $("#menu_name").css("border","1px solid #cf3c63");
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //      $("#menu_name").css("border","1px solid #9e9e9e");
          //
          //     }
          //
          //
          //
          //     if(file_name.trim()=="")
          //
          //     {
          //
          //         $("#file_name").css("border","1px solid #cf3c63");
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //      $("#file_name").css("border","1px solid #9e9e9e");
          //
          //     }
          //
          //
          //
          //
          //
          //     if(menu_name.trim()=="")
          //
          //     {
          //
          //         $("#menu_name").focus();
          //
          //     }
          //
          //     else if(file_name.trim()=="")
          //
          //     {
          //
          //         $("#file_name").focus();
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //         $("#save_main_menu").prop("disabled",true);
          //
          //         var formdata=new FormData($("#menu_form")[0]);
          //
          //         $.ajax({
          //
          //             url:"{{route('menu-insert')}}",
          //
          //             data: formdata,
          //
          //             type:"POST",
          //
          //             processData: false,
          //
          //             contentType: false,
          //
          //             success:function(response)
          //
          //             {
          //
          //                if(response.indexOf("exist")!=-1)
          //
          //                {
          //
          //                   swal("Already Exist!", "Menu Name already exists");
          //
          //                }
          //
          //               else if(response.indexOf("success")!=-1)
          //
          //               {
          //
          //                 swal({title:"Success",text:"Menu Created Successfully !",type: "success"},
          //
          //                  function(){
          //
          //                      location.reload();
          //
          //                  });
          //
          //               }
          //
          //               else if(response.indexOf("fail")!=-1)
          //
          //               {
          //
          //                swal("ERROR", "Menu cannot be inserted right now! ");
          //
          //               }
          //
          //                 $("#save_main_menu").prop("disabled",false);
          //
          //             }
          //
          //         });
          //
          //     }
          //
          //
          //
          //
          //
          //
          //
          // });
          //
          //
          //
          //
          //
          // $(document).on("click","#save_sub_menu",function()
          //
          // {
          //
          // 	 var menu_pid_sub=$("#menu_pid_sub").val();
          //
          //     var sub_menu_name=$("#sub_menu_name").val();
          //
          //     var sub_file_name=$("#sub_file_name").val();
          //
          //
          //
          //      if(menu_pid_sub.trim()=="0")
          //
          //     {
          //
          //         $("#menu_pid_sub").css("border","1px solid #cf3c63");
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //      $("#menu_pid_sub").css("border","1px solid #9e9e9e");
          //
          //     }
          //
          //
          //
          //     if(sub_menu_name.trim()=="")
          //
          //     {
          //
          //         $("#sub_menu_name").css("border","1px solid #cf3c63");
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //      $("#sub_menu_name").css("border","1px solid #9e9e9e");
          //
          //     }
          //
          //
          //
          //     if(sub_file_name.trim()=="")
          //
          //     {
          //
          //         $("#sub_file_name").css("border","1px solid #cf3c63");
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //      $("#sub_file_name").css("border","1px solid #9e9e9e");
          //
          //     }
          //
          //
          //
       		//  if(menu_pid_sub.trim()=="0")
          //
          //     {
          //
          //         $("#menu_pid_sub").focus();
          //
          //     }
          //
          //     else if(sub_menu_name.trim()=="")
          //
          //     {
          //
          //         $("#sub_menu_name").focus();
          //
          //     }
          //
          //     else if(sub_file_name.trim()=="")
          //
          //     {
          //
          //         $("#sub_file_name").focus();
          //
          //     }
          //
          //     else
          //
          //     {
          //
          //         $("#save_sub_menu").prop("disabled",true);
          //
          //         var formdata=new FormData($("#sub_menu_form")[0]);
          //
          //         $.ajax({
          //
          //             url:"{{route('menu-insert')}}",
          //
          //             data: formdata,
          //
          //             type:"POST",
          //
          //             processData: false,
          //
          //             contentType: false,
          //
          //             success:function(response)
          //
          //             {
          //
          //                if(response.indexOf("exist")!=-1)
          //
          //                {
          //
          //                   swal("Already Exist!", "Menu Name already exists");
          //
          //                }
          //
          //               else if(response.indexOf("success")!=-1)
          //
          //               {
          //
          //                 swal({title:"Success",text:"Sub Menu Created Successfully !",type: "success"},
          //
          //                  function(){
          //
          //                      location.reload();
          //
          //                  });
          //
          //               }
          //
          //               else if(response.indexOf("fail")!=-1)
          //
          //               {
          //
          //                swal("ERROR", "Sub Menu cannot be inserted right now! ");
          //
          //               }
          //
          //                 $("#save_sub_menu").prop("disabled",false);
          //
          //             }
          //
          //         });
          //
          //     }
          //
          //
          //
          //
          //
          //
          //
          // });

  </script>
@endpush
