@extends('agent::layouts.master')

@section('title', ' Activity')

@section('content')
    <form method="post" id="filters">
        @csrf
        <div class="box">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-3 mb-30">
                        <div class="form-group">
                            <label for="country_id">Country <span class="asterisk">*</span></label>
                            {!! Form::select('country_id', getCountries(true), null, ['class' => 'form-select select2', 'id' => 'country_id', 'placeholder' => '--Select Country--', 'onchange' => 'getCitiesOnChangeCountry($(this).val())']) !!}
                        </div>
                    </div>
                    <div class="col-md-3 mb-30">
                        <div class="form-group">
                            <label for="city_id">City <span class="asterisk">*</span></label>
                            {!! Form::select('city_id', [], null, ['class' => 'form-select select2', 'id' => 'getCityHtml', 'placeholder' => 'Select City', 'placeholder' => '--Select country first--']) !!}
                        </div>
                    </div>
                    <div class="col-md-3 mb-30">
                        <div class="form-group">
                            <label for="booking_date">Booking Date <span class="asterisk">*</span></label>
                            <div class="input-group date">
                                {!! Form::text('booking_date', date('Y-m-d'), ['class' => 'form-control pull-right datepicker', 'id' => 'booking_date']) !!}
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-3 mb-30">
                        <div class="form-group">
                            <label for="activity_type_id">Activity type </label>
                            {!! Form::select('activity_type_id', getActivityTypes()->pluck('activity_type_name', 'id'), null, ['class' => 'form-select', 'id' => 'activity_type_id', 'placeholder' => '--All Activity Type--']) !!}
                        </div>
                    </div>
                    <div class="col-md-2 mx-auto">
                        <button class="btn btn-primary btn-xl"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @push('scripts')
        <script>
            $(document).ready(function() {
                var date = new Date();
                date.setDate(date.getDate());
                $('#booking_date').datepicker({
                    autoclose: true,
                    todayHighlight: true,
                    format: 'yyyy-mm-dd',
                    startDate: date
                }).on('changeDate', function(e) {
                    var date_from = $("#date_from").datepicker("getDate");
                    var date_to = $("#date_to").datepicker("getDate");

                    if (!date_to) {
                        $('#date_to').datepicker("setDate", date_from);
                    } else if (date_to < date_from) {
                        $('#date_to').datepicker("setDate", date_from);
                    }
                });
            })

            $(document).on('submit','#filters', function(){
                event.preventDefault();
                var filters = new FormData($(this)[0]);
                $.ajax({
                    type: "post",
                    url: "{{ route('agent.activities') }}",
                    data: filters,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                    }
                });
            })
        </script>
    @endpush
@endsection
