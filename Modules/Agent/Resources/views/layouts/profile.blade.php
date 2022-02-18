@extends('agent::layouts.master')

@section('content')
    <nav>
        <div class="nav nav-tabs" id="nav-tab">
            <a class="nav-item nav-link  {{ request()->routeIs('agent.profile.show') || request()->routeIs('agent.profile.edit')  ? 'active' :'' }}"  href="{{ route('agent.profile.show', encrypt($agent->id)) }}"
                role="tab" aria-controls="nav-basic-details" aria-selected="true">Agent Detail</a>
            <a class="nav-item nav-link {{ request()->routeIs('agent.profile.banks') ? 'active' :'' }}"  href="{{ route('agent.profile.banks', encrypt($agent->id)) }}" role="tab"
                aria-controls="nav-bank-details" >Bank Detail</a>
            <a class="nav-item nav-link  {{ request()->routeIs('agent.profile.services') ? 'active' :'' }}"  href="{{ route('agent.profile.services', encrypt($agent->id)) }}"
                role="tab" aria-controls="nav-service-details" >Services Detail</a>
            <a class="nav-item nav-link  {{ request()->routeIs('agent.profile.contacts') ? 'active' :'' }}"  href="{{ route('agent.profile.contacts', encrypt($agent->id)) }}" role="tab"
                aria-controls="nav-contact-person" >Contact Persons</a>
            <a class="nav-item nav-link  {{ request()->routeIs('agent.profile.password') ? 'active' :'' }}"  href="{{ route('agent.profile.password', encrypt($agent->id)) }}" role="tab"
                aria-controls="nav-contact-person" >Change Password</a>
        </div>
    </nav>
    <div class="box">
        <div class="box-body">
          @yield('profile')
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
    </div>
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
