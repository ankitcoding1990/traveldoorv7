@extends('supplier::layouts.master')

@section('title', 'Supplier Profile')
@php
    $currentRoute  = Route::currentRouteName();
@endphp
@section('content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link {{Str::contains($currentRoute, 'profile') ? 'active' : ''}}" id="nav-basic-details-tab" 
                href="{{route('supplier.profile.index')}}" role="tab" > {{Str::contains($currentRoute, 'edit') ? 'Edit Profile' : 'Supplier Detail'}}</a>
            <a class="nav-item nav-link {{Str::contains($currentRoute, 'bank') ? 'active' : ''}}" 
                href="{{route('sbanks.index')}}" >Bank Detail</a>
            <a class="nav-item nav-link {{Str::contains($currentRoute, 'services') ? 'active' : ''}}" 
                href="{{route('services.index')}}">Services Detail</a>
            <a class="nav-item nav-link {{Str::contains($currentRoute,'scontact') ? 'active' : ''}}"
                href="{{route('scontact.index')}}" >Contact Persons</a>
            <a class="nav-item nav-link {{Str::contains($currentRoute,'sreset') ? 'active' : ''}}"
                href="{{route('sreset.index')}}" >Change Password</a>
        </div>
    </nav>
    {{-- PROFILE LAYOUT --}}
    <div class="box">
        <div class="box-body">
            <div class="tab-content py-2" id="nav-tabContent">
                @yield('profile')
            </div>
                <div class="row mb-10">
                    <div class="col-md-12">
                        <div class="box-header with-border"
                            style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                            <button type="button" id="discard_agent"
                                class="btn btn-sm btn-secondary">BACK</button>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    {{-- /PROFILE LAYOUT --}}
    
@endsection



@push('scripts')
    <script>
        


        $(document).on("click", "#country_operation", function() {
            if ($(this).hasClass('fa-minus-circle')) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
            $("#country_operation_details").toggle();
        });
        $(document).on("click", "#currency_operation", function() {
            if ($(this).hasClass('fa-minus-circle')) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
            $("#currency_operation_details").toggle();
        });
        $(document).on("click", "#blackout_days", function() {
            if ($(this).hasClass('fa-minus-circle')) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
            $("#blackout_days_details").toggle();
        });
        $(document).on("click", "#bank_details", function() {
            if ($(this).hasClass('fa-minus-circle')) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
            $("#agent_bank_details").toggle();
        });
        $(document).on("click", "#service_details", function() {
            if ($(this).hasClass('fa-minus-circle')) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
            $("#service_type_details").toggle();
        });
        $(document).on("click", "#contact_details", function() {
            if ($(this).hasClass('fa-minus-circle')) {
                $(this).removeClass('fa-minus-circle').addClass('fa-plus-circle');
            } else {
                $(this).removeClass('fa-plus-circle').addClass('fa-minus-circle');
            }
            $("#agent_contact_details").toggle();
        });
        $("#discard_agent").on("click", function() {
            window.history.back();
        });
    </script>
@endpush