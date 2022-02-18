{!! Form::hidden('activity_id', $id ?? null) !!}
{!! Form::hidden('master_from_date', $fromDate ?? null, ['id' => 'master_from_date']) !!}
{!! Form::hidden('master_to_date', $toDate ?? null, ['id' => 'master_to_date']) !!}
<div class="row border-bottom py-3">
    @php
        $i = 0;
    @endphp
    @if (isset($model) && count($model) > 0)
        @foreach ($model as $key => $booking)
            <div class="row py-2 parent-div">
                {!! Form::hidden('session[' . $i . '][id]', $booking->id, ['class' => 'session_id']) !!}
                @if ($i == 0)
                    <h3>Booking Availablity</h3>
                @endif
                <div class="col-sm-6">
                    <label>From date</label>
                    {!! Form::text('session[' . $i . '][from_date]', $booking->from_date ?? null, ['class' => 'form-control datepicker validate datefrom', 'id' => 'from_date', 'placeholder' => 'Booking From Date', 'autocomplete' => 'off']) !!}
                </div>
                <div class="col-sm-6">
                    <label>To date</label>
                    {!! Form::text('session[' . $i . '][to_date]', $booking->to_date ?? null, ['class' => 'form-control datepicker validate dateto', 'id' => 'to_date', 'placeholder' => 'Booking To Date', 'autocomplete' => 'off']) !!}
                </div>
                <div class="col-sm-12">
                    @php
                        $j = 0;
                    @endphp
                    @foreach ($booking->time_from as $k => $duration)
                        <div class="row border m-3 p-3 child-div">
                            <div class="col-sm-6">
                                <label>Time <small>(From)</small></label>
                                <div class="bootstrap-timepicker">
                                    <div class="input-group">
                                        {!! Form::text('session[' . $i . '][time_from][]', $duration ?? null, ['class' => 'form-control validate timePicker', 'id' => 'time_from', 'placeholder' => 'Booking Time From ', 'autocomplete' => 'off']) !!}
                                        <small class="invalid-feedback"></small>
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>Time <small>(to)</small></label>
                                <div class="bootstrap-timepicker">
                                    <div class="input-group">
                                        {!! Form::text('session[' . $i . '][time_to][]', $booking->time_to[$key] ?? null, ['class' => 'form-control validate timePicker', 'id' => 'time_to', 'placeholder' => 'Booking Time To', 'autocomplete' => 'off']) !!}
                                        <small class="invalid-feedback"></small>
                                        <div class="input-group-addon">
                                            <i class="fa fa-clock-o"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label>No. Of Pax</label>
                                {!! Form::text('session[' . $i . '][no_of_pax][]', $booking->no_of_pax[$key] ?? null, ['class' => 'form-control validate', 'id' => 'no_of_pax', 'placeholder' => 'No. Of Persons']) !!}
                            </div>
                            <div class="col-sm-3">
                                <label>Surge</label>
                                {!! Form::text('session[' . $i . '][surge][]', $booking->surge[$key] ?? null, ['class' => 'form-control', 'id' => 'surge', 'placeholder' => 'increment %']) !!}
                            </div>
                            <div class="col-sm-3">
                                <label>Discount</label>
                                {!! Form::text('session[' . $i . '][discount][]', $booking->discount[$key] ?? null, ['class' => 'form-control', 'id' => 'discount', 'placeholder' => 'decrement %']) !!}
                            </div>
                            <div class="col-sm-12 m-2">
                                @if ($j == 0)
                                    <button type="button" class="btn btn-info add-time mx-auto"><i
                                            class="fa fa-plus" aria-hidden="true"></i> Duration</button>
                                @else
                                    <button type="button" class="btn btn-info remove-time mx-auto"><i
                                            class="fa fa-minus" aria-hidden="true"></i> Duration</button>
                                @endif
                            </div>
                        </div>
                        @php
                            $j++;
                        @endphp
                    @endforeach
                </div>
                <div class="col-sm-4">
                    @if ($i == 0)
                        <button type="button" class="btn btn-danger add-session"><i class="fa fa-plus"
                                aria-hidden="true"></i> Session</button>
                    @else
                        <button type="button" class="btn btn-danger remove-session"><i class="fa fa-minus"
                                aria-hidden="true"></i> Session</button>
                    @endif
                </div>
            </div>
            @php
                $i++;
            @endphp
        @endforeach
    @else
        <div class="row py-2 parent-div">
            <h3>Booking Availablity</h3>
            <div class="col-sm-6">
                <label>From date</label>
                {!! Form::text('session[0][from_date]', null, ['class' => 'form-control datepicker validate datefrom', 'id' => 'from_date', 'placeholder' => 'Booking From Date', 'autocomplete' => 'off']) !!}
            </div>
            <div class="col-sm-6">
                <label>To date</label>
                {!! Form::text('session[0][to_date]', null, ['class' => 'form-control datepicker validate dateto', 'id' => 'to_date', 'placeholder' => 'Booking To Date', 'autocomplete' => 'off']) !!}
            </div>
            <div class="col-sm-12">
                <div class="row border m-3 p-3 child-div">
                    <div class="col-sm-6">
                        <label>Time <small>(From)</small></label>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                {!! Form::text('session[0][time_from][]', null, ['class' => 'form-control validate timePicker', 'id' => 'time_from', 'placeholder' => 'Booking Time From ', 'autocomplete' => 'off']) !!}
                                <small class="invalid-feedback"></small>
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Time <small>(to)</small></label>
                        <div class="bootstrap-timepicker">
                            <div class="input-group">
                                {!! Form::text('session[0][time_to][]', null, ['class' => 'form-control validate timePicker', 'id' => 'time_to', 'placeholder' => 'Booking Time To', 'autocomplete' => 'off']) !!}
                                <small class="invalid-feedback"></small>
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>No. Of Pax</label>
                        {!! Form::text('session[0][no_of_pax][]', null, ['class' => 'form-control validate', 'id' => 'no_of_pax', 'placeholder' => 'No. Of Persons']) !!}
                    </div>
                    <div class="col-sm-3">
                        <label>Surge</label>
                        {!! Form::text('session[0][surge][]', null, ['class' => 'form-control', 'id' => 'surge', 'placeholder' => 'increment %']) !!}
                    </div>
                    <div class="col-sm-3">
                        <label>Discount</label>
                        {!! Form::text('session[0][discount][]', null, ['class' => 'form-control', 'id' => 'discount', 'placeholder' => 'decrement %']) !!}
                    </div>
                    <div class="col-sm-12 m-2"><button type="button" class="btn btn-info add-time mx-auto"><i
                                class="fa fa-plus" aria-hidden="true"></i> Duration</button></div>
                </div>
            </div>
            <div class="col-sm-4">
                <button type="button" class="btn btn-danger add-session"><i class="fa fa-plus"
                        aria-hidden="true"></i> Session</button>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script>
        $(document).on('click', '.remove-time, .remove-session', function() {
           if ($(this).hasClass('remove-session')) {
                if ($(this).parent().parent().find('.session_id').length > 0) {
                    var activity_id = $('#activity_id').val()
                    var booking_id = $(this).parent().parent().find('.session_id').val();
                    var element = $(this);
                    var data = {
                        '_token': csrfToken(),
                        'activity_id': activity_id,
                        'booking_id': booking_id
                    }
                    var url = '{!! url("/services/activity/'+activity_id+'/booking/'+booking_id+'") !!}';
                    var message = "Removing this session will totally affect this and removes this session";
                    AlertAndDelete(message, url, data, element);
                } else {
                    $(this).parent().parent().remove();
                }
            } else {
                $(this).parent().parent().remove();
            }
        })
        $(document).on('click', '.add-session', function() {
            var another = $(this).parent().parent().clone();
            $(another).find('h3').remove();
            $(another).find('.session_id').remove()
            $(another).children('.col-sm-12').children('.row').find('.remove-time').parent().parent().remove()
            $(another).children('.col-sm-4').find('.add-session').removeClass('add-session').addClass(
                'remove-session').html('<i class="fa fa-minus" aria-hidden="true"></i> Session')
            $(another).children('div').find('input').val('')
            var parent_count = $('.parent-div').length
            $(another).children('div').find('#from_date').attr('name', 'session[' + parent_count + '][from_date]')
                .datepicker({
                    todayHighlight: true,
                    format: 'yyyy-mm-dd',
                    autoclose: true
                })
            $(another).children('div').find('#to_date').attr('name', 'session[' + parent_count + '][to_date]')
                .datepicker({
                    todayHighlight: true,
                    format: 'yyyy-mm-dd',
                    autoclose: true
                })
            $(another).children('.col-sm-12').children('div').find('#time_from').attr('name', 'session[' +
                parent_count + '][time_from][]')
            $(another).children('.col-sm-12').children('div').find('#time_to').attr('name', 'session[' +
                parent_count + '][time_to][]')
            $(another).children('.col-sm-12').children('div').find('#no_of_pax').attr('name', 'session[' +
                parent_count + '][no_of_pax][]')
            $(another).children('.col-sm-12').children('div').find('#surge').attr('name', 'session[' +
                parent_count + '][surge][]')
            $(another).children('.col-sm-12').children('div').find('#discount').attr('name', 'session[' +
                parent_count + '][discount][]')
            $(another).children('.col-sm-12').children('.child-div').find('.timePicker').timepicker({
                defaultTime: 'current',
                showInputs: false,
                minuteStep: 5,
                timeFormat: 'HH:mm ss',
                template: 'dropdown'
            })
            $(another).insertAfter($('.parent-div:last-child'))
        })
        $(document).on('click', '.add-time', function() {
            var another = $(this).parent().parent().clone();
            $(another).children('.col-sm-12').find('.add-time').removeClass('add-time').addClass('remove-time')
                .html('<i class="fa fa-minus" aria-hidden="true"></i> Duration')
            $(another).children('div').find('.timePicker').timepicker({
                defaultTime: 'current',
                showInputs: false,
                minuteStep: 5,
                timeFormat: 'HH:mm ss',
                template: 'dropdown'
            })
            $(another).children('div').find('input').val('');
            $(another).insertAfter($(this).parent().parent().parent().find('.child-div:last'));
        })

        $(document).on('change', '.datefrom, .dateto', function() {
            var masterfrom = new Date($('#master_from_date').val());
            var masterto = new Date($('#master_to_date').val());
            if ($(this).hasClass('datefrom')) {
                var fromdate = new Date($(this).val());
                var todate = new Date($(this).parent().siblings('.col-sm-6').children('.dateto'));
                if ($(this).parent().siblings('.col-sm-6').children('.dateto').val() != "") {
                    if (fromdate.getTime() > todate.getTime()) {
                        if ($(this).siblings('.error-from').length == 0) {
                            $(this).parent().append(
                                '<span class="error-from">from date must be less than from (to date)</span>');
                        }
                    } else if (todate.getTime() < fromdate.getTime()) {
                        if ($(this).siblings('.error-from').length == 0) {
                            $(this).parent().append(
                                '<span class="error-from">from date must be less than from (to date)</span>');
                        }
                    } else if (fromdate.getTime() < masterfrom.getTime()) {
                        if ($(this).siblings('.error-from').length == 0) {
                            $(this).parent().append(
                                '<span class="error-from">from date must be lie between (master date)</span>');
                        }
                    } else if (fromdate.getTime() > masterto.getTime()) {
                        if ($(this).siblings('.error-from').length == 0) {
                            $(this).parent().append(
                                '<span class="error-from">from date must be lie between (master date)</span>');
                        }
                    } else {
                        if ($(this).siblings('.error-from').length > 0) {
                            $(this).siblings('.error-from').remove()
                        }
                    }
                } else {
                    if (fromdate.getTime() < masterfrom.getTime()) {
                        if ($(this).siblings('.error-from').length == 0) {
                            $(this).parent().append(
                                '<span class="error-from">from date must be lie between (master date)</span>');
                        }
                    } else if (fromdate.getTime() > masterto.getTime()) {
                        if ($(this).siblings('.error-from').length == 0) {
                            $(this).parent().append(
                                '<span class="error-from">from date must be lie between (master date)</span>');
                        }
                    } else {
                        if ($(this).siblings('.error-from').length > 0) {
                            $(this).siblings('.error-from').remove()
                        }
                    }
                }
            }
            if ($(this).hasClass('dateto')) {
                var todate = new Date($(this).val());
                var fromdate = new Date($(this).parent().siblings('.col-sm-6').children('.datefrom'));
                if ($(this).parent().siblings('.col-sm-6').children('.dateto').val() != "") {
                    if (todate.getTime() < fromdate.getTime()) {
                        if ($(this).siblings('.error-to').length == 0) {
                            $(this).parent().append(
                                '<span class="error-to">to date must be greater than from (from date)</span>');
                        }
                    } else if (fromdate.getTime() > todate.getTime()) {
                        if ($(this).siblings('.error-to').length == 0) {
                            $(this).parent().append(
                                '<span class="error-to">to date must be greater than from (from date)</span>');
                        }
                    } else if (todate.getTime() < masterfrom.getTime()) {
                        if ($(this).siblings('.error-to').length == 0) {
                            $(this).parent().append(
                                '<span class="error-to">to date must be lie between (master date)</span>');
                        }
                    } else if (todate.getTime() > masterto.getTime()) {
                        if ($(this).siblings('.error-to').length == 0) {
                            $(this).parent().append(
                                '<span class="error-to">to date must be lie between (master date)</span>');
                        }
                    } else {
                        if ($(this).siblings('.error-to').length > 0) {
                            $(this).siblings('.error-to').remove()
                        }
                    }
                } else {
                    if (todate.getTime() < masterfrom.getTime()) {
                        if ($(this).siblings('.error-to').length == 0) {
                            $(this).parent().append(
                                '<span class="error-to">to date must be lie between (master date)</span>');
                        }
                    } else if (todate.getTime() > masterto.getTime()) {
                        if ($(this).siblings('.error-to').length == 0) {
                            $(this).parent().append(
                                '<span class="error-to">to date must be lie between (master date)</span>');
                        }
                    } else {
                        if ($(this).siblings('.error-to').length > 0) {
                            $(this).siblings('.error-to').remove()
                        }
                    }
                }
            }
        })
    </script>
@endpush
