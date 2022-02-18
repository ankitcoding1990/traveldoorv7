<script src="{{ asset('assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/functions.js') }}"></script>

<script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('assets/ckeditor/samples/js/sample.js') }}"></script>
{{-- input mask --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8-beta.7/jquery.inputmask.min.js" integrity="sha512-x3zoB6e8YsZipoDoCTClRYkEpqucilZ8IYsaJFE0XUtUJQdO7v2xFzvd1zQKrb3ParCNpvdAE0C85msCw3NrLA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- jQuery 3 -->
<!-- fullscreen -->
<script src="{{ asset('assets/vendor_components/screenfull/screenfull.js') }}"></script>
<script src="{{ asset('assets/js/pages/advanced-form-element.js') }}"></script>
<!-- Bootstrap tagsinput -->
<script src="{{ asset('assets/vendor_components/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
<!-- Bootstrap touchspin -->
<!-- popper -->
{{-- google Location API --}}
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCw1R6jaQDMmtHhShu1teQ62F40JYWmVjE&libraries=places&language=en"></script>
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
{{-- datepicker --}}
<script src="{{ asset('assets/vendor_components/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<!-- bootstrap datetimepicker -->
<script src="{{ asset('assets/vendor_components/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<!-- bootstrap time picker -->

<script src="{{ asset('assets/vendor_plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
{{-- agents --}}
{{-- <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script> --}}
<script src="{{ asset('assets/js/pages/data-table.js') }}"></script>
{{-- /agents --}}
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>
<script src="{{ asset('assets/vendor_components/bootstrap-select/js/bootstrap-select.js') }}"></script>
<!-- VoiceX Admin for editor -->
{{-- agents --}}
<script src="{{ asset('assets/js/pages/editor.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/iCheck/icheck.min.js') }}"></script>
{{-- agents --}}

<link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<!-- VoiceX Admin App -->
<script src="{{ asset('assets/js/template.js') }}"></script>
<script src="{{ asset('assets/js/pages/voice-search.js') }}"></script>
<script src="{{ asset('assets/vendor_plugins/input-mask/jquery.inputmask.js') }}"></script>
<!-- VoiceX Admin dashboard demo (This is only for demo purposes) -->
<!-- <script src="{{ asset('assets/js/pages/dashboard4.js') }}"></script> -->
<script src="{{ asset('assets/vendor_components/select2/js/select2.full.js') }}"></script>
<!-- VoiceX Admin for demo purposes -->
<script src="{{ asset('assets/js/demo.js') }}"></script>
<script src="{{ asset('assets/js/pages/advanced-form-element.js') }}"></script>
<script src="{{ asset('assets/vendor_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/vendor_components/sweetalert/jquery.sweet-alert.custom.js') }}"></script>
<script src="{{ asset('assets/intl-tel-input-master/build/js/intlTelInput-jquery.js') }}"></script>

<!-- Sweet Alert CDN -->

<!-- Toaster Script -->
<script src="{{ asset('assets/toast/build/toastr.min.js') }}"></script>


{{-- datatables --}}
{{-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script> --}}
{{-- datatable buttons --}}
{{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> --}}

{{-- datatable latest --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script> --}}
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>

<script>

  $(document).ready(function(){
    $("#flag-div").on("click", function () {
      $("#list-c").removeClass("hide")
    })
    $(".country").on("click", function () {
      alert($(this).data("dial-code"))
    });
    $(document).on("click",".remove_upload_ativity_images",function(){
      $(this).parent().remove();
    });

    // window

    // $(window).on('mouseover', (function ()
    // {
    //   window.onbeforeunload = null;
    // }));

    // $(window).on('mouseout', (function (){
    //     window.onbeforeunload = function () {
    //       return 'Are you really want to perform the action?';
    //     };
    // }));


  });
</script>
