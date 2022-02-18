<script src="{{ asset('assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>
<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
<script>
	// initSample();
</script>
<!-- jQuery 3 -->
<!-- fullscreen -->
<script src="{{ asset('assets/vendor_components/screenfull/screenfull.js') }}"></script>
<script src="{{ asset('assets/js/pages/advanced-form-element.js') }}"></script>
<!-- Bootstrap tagsinput -->
<script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Bootstrap touchspin -->
<!-- popper -->
<script src="{{ asset('assets/vendor_components/popper/popper.min.js') }}"></script>
<!-- Bootstrap 4.0-->
<!-- date-range-picker -->
<!-- Slimscroll -->
<script src="{{ asset('assets/vendor_components/jquery-slimscroll/jquery.slimscroll.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('assets/vendor_components/fastclick/lib/fastclick.js') }}"></script>
<!-- eChart Plugins -->
<!-- <script src="assets/vendor_components/echarts/echarts-en.min.js"></script> -->
<!-- Sparkline -->
<script src="{{ asset('assets/vendor_components/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<!-- toast -->
<script src="{{ asset('assets/vendor_components/jquery-toast-plugin-master/src/jquery.toast.js') }}"></script>
<!-- bootstrap datepicker -->
<script src="{{ asset('assets/vendor_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<!-- bootstrap datetimepicker -->
<script src="{{ asset('assets/vendor_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
  <!-- Bootstrap Clock Picker -->
 <script src="{{ asset('assets/vendor_plugins/clockpicker/dist/bootstrap4-clockpicker.min.js') }}"></script>
<!-- bootstrap time picker -->
<script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- VoiceX Admin for editor -->
<!-- <script src="{{ asset('assets/js/pages/editor.js') }}"></script> -->
<script src="{{ asset('assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>
<!-- VoiceX Admin App -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<!-- <script src="{{ asset('assets/js/pages/voice-search.js') }}"></script> -->
<!-- <script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script> -->
<!-- VoiceX Admin dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('assets/js/pages/dashboard4.js') }}"></script> -->
<script src="{{ asset('assets/vendor_components/select2/js/select2.full.js') }}"></script>
<!-- VoiceX Admin for demo purposes -->
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/pages/advanced-form-element.js') }}"></script>
<script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<!--daman-->
<script src="{{ asset('assets/vendor_components/OwlCarousel2/owl.carousel.js') }}"></script>
	<!-- flexslider -->
<script src="{{ asset('assets/vendor_components/flexslider/jquery.flexslider.js') }}"></script>
<script src="{{ asset('assets/js/pages/slider.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/bootstrap-slider/bootstrap-slider.js') }}"></script>
<script>
	$("#flag-div").on("click", function () {
		$("#list-c").removeClass("hide")
	})
	$(".country").on("click", function () {
		alert($(this).data("dial-code"))
	})
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
//     //multiple file rendering
//  function handleFileSelect(event) {
//     //Check File API support
//     if (window.File && window.FileList && window.FileReader) {
//         var files = event.target.files; //FileList object
//         var output = document.getElementById("previewImg");
//         output.innerHTML="";
//         for (var i = 0; i < files.length; i++) {
//             var file = files[i];
//             //Only pics
//             if (!file.type.match('image')) continue;
//             var picReader = new FileReader();
//             picReader.addEventListener("load", function (event) {
//                 var picFile = event.target;
//                 var div = document.createElement("div");
//                  div.className = 'col-md-3';
//                 div.innerHTML = "<img class='upload_ativity_images_preview' src='" + picFile.result + "'" + "title='" + file.name + "' width=150 height=150 />";
//                 output.insertBefore(div, null);
//             });
//             //Read the image
//             picReader.readAsDataURL(file);
//         }
//     } else {
//         console.log("Your browser does not support File API");
//     }
// }
// document.getElementById('upload_ativity_images').addEventListener('change', handleFileSelect, false);
//   //end of multiple file rendering
// $(".sidebar-menu li a").on("click", function() {
//   $(".sidebar-menu li").find(".active").removeClass("active");
//   $(this).parent().addClass("active");
// });
$(function() {
  $('.sidebar-menu li a').each(function()
    {
      if($(this).attr("href")==location)
      {
        $(this).parent().addClass('active');
      }
    });
});
</script>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
  $(window).on('mouseover', (function ()
  {
    window.onbeforeunload = null;
  }));
  $(window).on('mouseout', (function ()
  {
   window.onbeforeunload = function () {
    return 'Are you really want to perform the action?';
  };
}));
</script>

