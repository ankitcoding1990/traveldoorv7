@extends('layouts.main')
@push('style')
<style>
    .iti-flag {
        width: 20px;
        height: 15px;
        box-shadow: 0px 0px 1px 0px #888;
        background-image: url("{{asset('assets/images/flags.png')}}") !important;
        background-repeat: no-repeat;
        background-color: #DBDBDB;
        background-position: 20px 0
    }

    div#cke_1_contents {
        height: 250px !important;
    }
</style>
@endpush

@section('title','Acceptance Pdf Master')

@section('main')

@if(auth()->user()->hasViewPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Acceptance Pdf Master</h4>
            </div>
            <div class="box-body">
                {!! Form::model($acceptance, ['method' => 'post', 'class' => 'acceptance_pdf_form','onsubmit="ValidateForm($(this))"','route' => 'acceptance_master.store']) !!}
                    <div class="row mb-10">
                        <div class="col-sm-12">
                            <h4 class="box-title" style="border-color: #c1c1c1;margin-top: 25px;">
                                <i class="fa fa-plus-circle"></i> ACCEPTANCE PDF (English)<span class="asterisk">*</span>
                            </h4>
                        </div>
                        {!! Form::hidden('id', NULL) !!}
                        <div class="col-sm-12">
                            <div class="box">
                                <!-- /.box-header -->
                                <div class="box-body">
                                    {!! Form::textarea('acceptance_pdf_english', NULL , ['id' => 'acceptance_pdf_eng' , 'rows' => '11' ,'class' => 'form-control']) !!}
                                    {{-- <textarea class="form-control" rows="11" id="acceptance_pdf_eng" name="acceptance_pdf_eng"></textarea> --}}
                                    <span class="text-danger" style="display: none" id="acceptance_pdf_eng_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(auth()->user()->hasAddPermission($routeName))
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit"  id="save_acceptance_pdf" class="btn btn-rounded btn-primary mr-10 pull-left">Submit</button>
                            </div>
                        </div>
                    @else
                        <h4 class="text-danger">No rights to Add Acceptance PDF.</h4>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@else 
<h4 class="text-danger">No rights to View.</h4>
@endif

@endsection

@push('scripts')
    <script>
        function ValidateForm(form) {
            event.preventDefault();
            var acceptance_pdf_eng_initial = $('#acceptance_pdf_eng').val();
            var acceptance_pdf_georgian_initial = $('#acceptance_pdf_georgian').val();
            if(acceptance_pdf_eng_initial.trim()==""){
                $('#acceptance_pdf_eng').val('[traveldoor_acceptance_customer_name] [traveldoor_acceptance_passport_no] [traveldoor_acceptance_booking_date] [traveldoor_acceptance_booking_services] [traveldoor_acceptance_booking_amount_converted] [traveldoor_acceptance_booking_currency] [traveldoor_acceptance_booking_amount] [traveldoor_acceptance_paid_in_gel]');
            }
            
            var acceptance_pdf_eng = $('#acceptance_pdf_eng').val();
            var call_ajax=true;
            if (acceptance_pdf_eng.trim() == "") {
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('This Field is Required').show();
                call_ajax=false;
            } else if (acceptance_pdf_eng.search("traveldoor_acceptance_customer_name") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_customer_name] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_passport_no") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_passport_no] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_booking_date") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_booking_date] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_booking_services") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_booking_services] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_booking_amount_converted") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_booking_amount_converted] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_booking_currency") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_booking_currency] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_booking_amount") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_booking_amount] has been changed. Please reset it.').show();
                call_ajax=false;
            }else if (acceptance_pdf_eng.search("traveldoor_acceptance_paid_in_gel") == -1){
                $("#cke_acceptance_pdf_eng").css("border", "3px solid rgb(249 23 83)");
                $('#acceptance_pdf_eng_error').text('[traveldoor_acceptance_paid_in_gel] has been changed. Please reset it.').show();
                call_ajax=false;
            }else{
                $("#cke_acceptance_pdf_eng").css("border", "1px solid #9e9e9e");
                $('#acceptance_pdf_eng_error').text('').hide();
            }

            if(call_ajax) {
                ajaxFormSubmit(form)
            }
        }
    
    </script>
@endpush