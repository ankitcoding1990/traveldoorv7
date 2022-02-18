@extends('layouts.main')
@section('title','Enquiry Management')

@push('style')
<style>
    .iti--allow-dropdown{
        width: 100% !important;
    }
    .btn{
        font-size: 1rem !important;
        padding: 5px 10px !important;
    }
    .file{
        border: 2px dashed #aaa;
        text-align: center;

    }
    .file > label{
        color: #aaa;
        padding: 4.6rem;
    }
</style>
@endpush

@section('main')
@php
    $rights  = rights();
@endphp
@if($rights['add']==1)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Create Enquiry</h4>
            </div>
            <div class="box-body">
                @include('mains.enquiry_management.enquiries._form')
            </div>
        </div>
    </div>
</div>
@else
    <h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection
@push('scripts')
    <script>
        $('#booking_range, #nxt_followup_date').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            }
        });
         $('#customer_contact').intlTelInput({
            utilsScript: "{{ asset('assets/intl-tel-input-master/build/js/utils.js') }}"
        });

        $('#customer_country').change(function(){
            fetchCities();
        })

        function fetchCities(){
        var country = $('#customer_country').val();
        $.ajax({
            url:'{{url("/get-cities")}}',
            dataType: 'JSON',
            method: 'get',
            data: {'country': country},
            success: function (response){
                if(response)
                {
                    html ='<option disabled selected hidden>--Select City--</option>'
                    $.each(response,function(key, value){
                        html += `<option value = ${key} >${value}</option>`
                    })
                }
                else{
                    html = '<option disabled selected hidden>--No Avalaible City For This Country--</option>'
                }
                $('#customer_city').html(html)
            }
        })
    }

    function previewFile() {
        var preview = document.querySelector('.preview-img');
        var file    = document.querySelector('#image').files[0];
        var label = document.querySelector('#file-label');
        var reader  = new FileReader();
        reader.onloadend = function () {
        preview.src = reader.result;
        preview.style.display="block";
        label.style.display = 'none';
        }
        if (file) {
        reader.readAsDataURL(file);
        } else {
        preview.src = "";
        label.style.display = 'block';
        preview.style.display="none";
        }
    }
    </script>
@endpush
