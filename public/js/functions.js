function validation(select) {
    var value = $('#' + select).val()
    var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
    if (value.trim() == "") {
        $("#" + select).css("border", "1px solid #cf3c63");
        $("#" + select).focus();
        if (!$('.error-msg').length > 0)
            $("#" + select).parent('div').append(error)
        return false;
    } else {
        $("#" + select).css("border", "1px solid #9e9e9e");
        if ($('.error-msg').length > 0)
            $('.error-msg').remove();
    }
    return true;
}

function Validate() {
    var vali = true;
    $('.validate').each(function () {
        if ($(this).attr('type') === 'radio') {
            var error_msg = $(this).attr('error_msg');
            var error_class = $(this).attr('error_class');
            if (!$(this).is(':checked')) {
                $('.' + error_class + '_radio').css("border", "1px solid red")
                $('.' + error_class + '_has_error').text(error_msg).show();
                vali = false;
            }
        } else {
            var data = $(this).val();
            if (data == "") {
                if ($(this).siblings('small').length == 0) {
                    $(this).css({
                        "border": "1px solid red"
                    });
                    $(this).parent().append('<small style="color: red;">This Field is Required</small>');
                    $(this).focus();
                }
                vali = false;
            } else {
                $(this).css({
                    "border": "1px solid #9e9e9e"
                });
            }
        }
    });
    return vali;
}
$(document).ready(function () {
    $('.timePicker').timepicker({
        defaultTime: 'current',
        showInputs: false,
        minuteStep: 5,
        timeFormat: 'HH:mm ss',
        template: 'dropdown'
    });

    $('.datepicker-current').datepicker({
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
        endDate: new Date(),
    });
    $('.datepicker-future').datepicker({
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
        startDate: new Date(),
    });
    $('.datepicker-all').datepicker({
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        autoclose: true,
    });
    $('.datepicker-multiple').datepicker({
        multidate: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        startDate: new Date(),
    })
    $('.select2').select2();
})

$(document).on('change', '.validate', function () {
    var data = $(this).val();
    if (data != '' || data != 0) {
        $(this).css({
            "border": "1px solid #9e9e9e"
        });
        $(this).parent().find('small').remove();
    }
})

$(document).on('input', '.isNumeric', function () {
    this.value = this.value.replace(/[^0-9]/g, '');
});
$(document).on('input', '.isAlpha', function () {
    this.value = this.value.replace(/[^a-zA-Z .]/g, '');
});
$(document).on('input', '.isAlpaNumeric', function () {
    this.value = this.value.replace(/[^a-zA-Z0-9 .]/g, '');
});

function ajaxFormSubmit(form, resetForm = true) {
    loader();
    event.preventDefault();
    var formdata = new FormData(form[0]);
    $.ajax({
        url: form.attr('action'),
        enctype: 'multipart/form-data',
        data: formdata,
        type: form.attr('method'),
        processData: false,
        contentType: false,
        success: function (response) {
            loader('stop');
            formInputErrorsClear(form);
            if (response.redirect !== undefined) {
                window.location.href = response.redirect;
            } else if (response.table !== undefined) {
                datatableRefresh(response.table);
            } else if (response.search_result != undefined) {
                $('#search_result').html(response.search_result)
            }
            else {
                // setTimeout(function () {
                //     window.location.reload()
                // }, 1000)
            }

            if(response.search_result == undefined){
                swal({
                    title: "Success",
                    text: response.message,
                    type: response.type
                });
            }

            if(resetForm){
                form[0].reset();
            }

        },
        error: function (error) {
            console.log(error);
            loader('stop');
            formInputErrorsClear(form);
            if (typeof error.responseJSON.errors == 'object') {
                formInputErrors(form, error.responseJSON.errors);
            } else if (typeof error.responseJSON.message == 'string') {
                swal({
                    title: "Warning",
                    text: error.responseJSON.message,
                    type: 'warning'
                });
            } else {
                swal({
                    title: "Warning",
                    text: error.responseJSON.message,
                    type: 'warning'
                });
            }
        }
    });
}

function datatableRefresh(table) {
    $('#' + table).DataTable().ajax.reload();
}

function getCountriesOnChangeSupplier(supplierId, country_id)
{
    $.ajax({
        type: "POST",
        url: baseUrl() + '/ajax/supplier/countries-render',
        data: {
            _token: csrfToken(),
            "supplier_id": supplierId,
            'country_id' :country_id
        },
        success: function (response) {
            // console.log(response.html);
            $('#getCountryHtml').html(response.html)
            $("#country_div").show();
            $('.select2').select2();
        }
    });
}

function getCitiesOnChangeCountry(countryId, cityId = null, selection = 'single') {
    $.ajax({
        type: "POST",
        url: baseUrl() + '/ajax/country/cities-render',
        data: {
            _token: csrfToken(),
            "country_id": countryId,
            'city_id' :cityId
        },
        success: function (response) {
            // console.log(response.html);
            $('#getCityHtml').html(response.html)
            $("#city_div").show();
            $('.select2').select2();
        }
    });
}

function ConfirmSwal(text, swalType, ajaxType, url, data) {
    console.log(ajaxType, url, data)
    swal({
            title: 'Are you sure?',
            text: text,
            type: swalType,
            showCancelButton: true,
            confirmButtonColor: "#4385f4",
            confirmButtonText: "Ok",
            cancelButtonText: 'Cancel',
            closeOnConfirm: true,
            closeOnCancel: true,
            dangerMode: true,
        },
        function (isok) {
            if (isok) {
                loader('show');
                $.ajax({
                    type: ajaxType,
                    url: url,
                    data: data,
                    success: function (response) {
                        console.log(response)
                        if (response.type) {
                            toasterMessage(response.type, response.subject);
                        } else {
                            toasterMessage(response[1], response[0]);
                        }
                        $('.dataTable').DataTable().ajax.reload();
                        loader('stop');
                        if (response[2]) {
                            setTimeout(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                    error: function () {
                        loader('stop');
                    }
                });
            }else{
                loader('stop');
            }
        });
}

function toasterMessage(type, message) {
    toastr[type](message)

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "4000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
}

// toasterMessage('info', 'Test Message');

function loader(show = 'show') {
    if (show == 'show') {
        $('#loader').show();
    } else {
        $('#loader').hide();
    }
}

$(document).on('change', '.form-control', function () {
    var errorMsg = $(this).siblings('.text-danger');
    if (errorMsg) {
        if (errorMsg.length != 0) {
            if ($(this).val() != '' || $(this).val() != null) {
                errorMsg.hide();
            }
        }
    }
});

function changeRoleGetUsers(role) {
    $.ajax({
        type: 'post',
        url: 'ajax/role/users',
        data: {
            _token: csrfToken(),
            role: role
        },
        success: function (result) {
            if (result.status == true) {
                $('#roleUsersHTML').html(result.html);
                $('.select2').select2();
            }
        },
        error: function (err) {
            console.log(err);
        }
    })
}

function datatableRefresh(table) {
    $('#' + table).DataTable().ajax.reload();
}

function deleteAlert(route, title = 'Delete', refresh = false) {
    $.ajax({
        type: 'DELETE',
        data: {
            _token: csrfToken(),
        },
        url: route,
        success: function (res) {

            if (res.status == true) {
                if (refresh = true) {
                    window.location.reload();
                } else {
                    if (res.redirect != undefined) {
                        window.location.href = res.redirect;
                    } else if (res.table != undefined) {
                        datatableRefresh(res.table);
                    } else {
                        window.location.reload();
                    }

                }
            } else {
                alert(res.message);
            }
        },
        error: function (err) {
            if (err.responseJSON.message != undefined) {
                alert(err.responseJSON.message);
            }
        }
    })
}


// ActiveOrInactive
function changeState(model_name, id, column = null, status = null){
    console.log(model_name, id, column , status)
    console.log('ajax/activeOrInactive/'+id+'/update')
    let displayStatus = null;
    let text;
    let swaltype = 'info';
    if(status == null || status == 'delete'){
        displayStatus = 'Inactive';
        text = 'You want to ' + displayStatus + ' this row ! ';
        swaltype='warning';
    }else if(status == 'permanent'){
        displayStatus = 'Delete';
        text = 'You want to ' + displayStatus + ' this row? Once deleted, you will not be able to recover ! ';
        swaltype='error';
    }else{
        displayStatus = 'Active';
        text = 'You want to ' + displayStatus + ' this row ! ';
        swaltype='info';
    }
    swal({
            title: 'Are you sure ?',
            text: text,
            type: swaltype,
            showCancelButton: true,
            confirmButtonColor: "#4385f4",
            confirmButtonText: displayStatus,
            cancelButtonText: 'Cancel',
            closeOnConfirm: true,
            closeOnCancel: true,
            dangerMode: true,
    },function (confirmed) {
        if(confirmed){
            $.ajax({
                type: 'put',
                url: baseUrl()+'/ajax/activeOrInactive/'+id+'/update',
                data: {
                     model_name : model_name,
                     status : status,
                     column : column,
                    _token : csrfToken()
                },
                success: function(response){
                    toasterMessage('info', response.message);
                    $('.dataTable').DataTable().ajax.reload();
                },
                error : function(){
                    toasterMessage('danger', 'Something went wreong!');
                }
            })
        }
    })
  }


// form discard
function discard() {
    window.history.back();
}

function formInputErrors(form, errors) {
    if (typeof errors != undefined) {
        $.each(errors, function (key, value) {
            // console.log('form= '+form+ ',key= '+key+ ',value= '+value );
            form.find('[name="' + key + '"]').addClass('is-invalid').next('.invalid-feedback').html(value);
            form.find('[name="' + key + '"]').addClass('is-invalid').siblings('.invalid-feedback').html(value);
            // form.find('select[name="' + key + '"]').addClass('is-invalid').siblings('.invalid-feedback').html(value);
        });
    }
}

function formInputErrorsClear(form) {
    form.find('.form-control, select, textarea').removeClass('is-invalid');
    form.find('.invalid-feedback').empty();
}


// theme scripts

// functions

function validateNumber(evt) {
    var theEvent = evt || window.event;
    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
}
//multiple file rendering
function handleFileSelect(event) {
  //Check File API support
  if (window.File && window.FileList && window.FileReader) {
      var files = event.target.files; //FileList object
      // alert(files.length);
      var output = document.getElementById("previewImg");
      output.innerHTML="";

      for (var i = 0; i < files.length; i++) {
          var file = files[i];
          var filesize = (files[i].size/1024).toFixed(4);

          //Only pics
          if (!file.type.match('image')) continue;

          if(filesize<=200)
          {
          var picReader = new FileReader();
          picReader.addEventListener("load", function (event) {
              var picFile = event.target;
              var div = document.createElement("div");
               div.className = 'col-md-3';
              div.innerHTML = "<img class='upload_ativity_images_preview' src='" + picFile.result + "'" + "title='" + file.name + "' width=150 height=150 />";
              output.insertBefore(div, null);
          });
          //Read the image
          picReader.readAsDataURL(file);
        }
        else
        {
          alert("Filesize should be less than or equal to 200kb");

        }
      }
  } else {
      console.log("Your browser does not support File API");
  }
}

// document.getElementById('upload_ativity_images').addEventListener('change', handleFileSelect, false);
//end of multiple file rendering

 //multiple file rendering
function handleFileSelectTransport(event,output) {
  //Check File API support
  if (window.File && window.FileList && window.FileReader) {
      var files = event.target.files; //FileList object
      var output = document.getElementById(output);
      output.innerHTML="";

      for (var i = 0; i < files.length; i++) {
          var file = files[i];
            var filesize = (files[i].size/1024).toFixed(4);
          //Only pics
          if (!file.type.match('image')) continue;

          if(filesize<=200)
          {
          var picReader = new FileReader();
          picReader.addEventListener("load", function (event) {
              var picFile = event.target;
              var div = document.createElement("div");
               div.className = 'col-md-12';
              div.innerHTML = "<img class='upload_ativity_images_preview' src='" + picFile.result + "'" + "title='" + file.name + "' width=150 height=150 />";
              output.insertBefore(div, null);
          });
          //Read the image
          picReader.readAsDataURL(file);
           }
        else
        {
          alert("Filesize should be less than or equal to 200kb");

        }
      }
  } else {
      console.log("Your browser does not support File API");
  }
}




