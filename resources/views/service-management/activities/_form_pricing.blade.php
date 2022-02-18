@push('style')
    <style>
        a#adult-tab,
        a#infant-tab {
            border-radius: 0 !important;
        }

    </style>
@endpush
{!! Form::hidden('activity_id', $id ?? null, ['id' => 'activity_id']) !!}
@isset($age_group)
    <div class="row border-bottom p-3 form-div age-wrapper">
        <div class="col-sm-3">
            <ul class="nav nav-tabs flex-column" id="myTab" role="tablist">
                @if ($age_group['adult']['allowed'] == 'Yes')
                    <li class="nav-item">
                        <a class="nav-link active" id="adult-tab" data-toggle="tab" href="#adult" role="tab"
                            aria-controls="adult" aria-selected="true">Adult</a>
                    </li>
                @endif
                @if ($age_group['child']['allowed'] == 'Yes')
                    <li class="nav-item">
                        <a class="nav-link" id="child-tab" data-toggle="tab" href="#child" role="tab"
                            aria-controls="child" aria-selected="false">Child</a>
                    </li>
                @endif
                @if ($age_group['infant']['allowed'] == 'Yes')
                    <li class="nav-item">
                        <a class="nav-link" id="infant-tab" data-toggle="tab" href="#infant" role="tab"
                            aria-controls="infant" aria-selected="false">Infant</a>
                    </li>
                @endif
            </ul>
        </div>
        <div class="col-sm-9">
            <div class="tab-content" id="myTabContent">
                @if ($age_group['adult']['allowed'] == 'Yes')
                    <div class="tab-pane fade show active" id="adult" role="tabpanel" aria-labelledby="adult-tab">
                        @if (isset($model) && count($model) > 0)
                            @php
                                $i = 0;
                            @endphp
                            @foreach ($model->where('pricing_for', 'adult') as $key => $prices)
                                <div class="row my-3 adult-div">
                                    {!! Form::hidden('adult[' . $i . '][id]', $prices->id ?? null, ['class' => 'pricing_id']) !!}
                                    <div class="col-sm-3">
                                        <label>Max Pax</label>
                                        {!! Form::text('adult[' . $i . '][max_pax]', $prices->max_pax ?? null, ['class' => 'form-control validate', 'id' => 'max_pax', 'placeholder' => 'Max Pax', 'min' => '1']) !!}
                                    </div>
                                    <div class="col-sm-3">
                                        <label>Price</label>
                                        {!! Form::text('adult[' . $i . '][price]', $prices->price ?? null, ['class' => 'form-control validate', 'id' => 'price', 'placeholder' => 'price', 'min' => '1']) !!}
                                    </div>
                                    <div class="col-sm-3 mt-4">
                                        @if ($i == 0)
                                            <button class="btn btn-primary addprice" type="button"><i class="fa fa-plus"
                                                    aria-hidden="true"></i> Add More</button>
                                        @else
                                            <button type="button" class="btn btn-primary removeprice"><i
                                                    class="fa fa-minus" aria-hidden="true"></i> Remove</button>
                                        @endif
                                    </div>
                                </div>
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        @else
                            <div class="row my-3 adult-div">
                                <div class="col-sm-3">
                                    <label>Max Pax</label>
                                    {!! Form::text('adult[0][max_pax]', null, ['class' => 'form-control validate', 'id' => 'max_pax', 'placeholder' => 'Max Pax', 'min' => '1']) !!}
                                </div>
                                <div class="col-sm-3">
                                    <label>Price</label>
                                    {!! Form::text('adult[0][price]', null, ['class' => 'form-control validate', 'id' => 'price', 'placeholder' => 'price', 'min' => '1']) !!}
                                </div>
                                <div class="col-sm-3 mt-4">
                                    <button class="btn btn-primary addprice" type="button"><i class="fa fa-plus"
                                            aria-hidden="true"></i> Add More</button>
                                </div>
                            </div>
                    </div>
                @endif
            </div>
            @endif
            @if ($age_group['child']['allowed'] == 'Yes')
                <div class="tab-pane fade" id="child" role="tabpanel" aria-labelledby="child-tab">
                    @if (isset($model) && count($model) > 0)
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($model->where('pricing_for', 'child') as $key => $prices)
                            <div class="row my-3 child-div">
                                {!! Form::hidden('child[' . $i . '][id]', $prices->id ?? null, ['class' => 'pricing_id']) !!}
                                <div class="col-sm-3">
                                    <label>Max Pax</label>
                                    {!! Form::text('child[' . $i . '][max_pax]', $prices->max_pax ?? null, ['class' => 'form-control validate', 'id' => 'max_pax', 'placeholder' => 'Max Pax', 'min' => '1']) !!}
                                </div>
                                <div class="col-sm-3">
                                    <label>Price</label>
                                    {!! Form::text('child[' . $i . '][price]', $prices->price ?? null, ['class' => 'form-control validate', 'id' => 'price', 'placeholder' => 'price', 'min' => '1']) !!}
                                </div>
                                <div class="col-sm-3 mt-4">
                                    @if ($i == 0)
                                        <button class="btn btn-primary addprice" type="button"><i class="fa fa-plus"
                                                aria-hidden="true"></i> Add More</button>
                                    @else
                                        <button type="button" class="btn btn-primary removeprice"><i class="fa fa-minus"
                                                aria-hidden="true"></i> Remove</button>
                                    @endif
                                </div>
                            </div>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @else
                        <div class="row my-3 child-div">
                            <div class="col-sm-3">
                                <label>Max Pax</label>
                                {!! Form::text('child[0][max_pax]', null, ['class' => 'form-control validate', 'id' => 'max_pax', 'placeholder' => 'Max Pax', 'min' => '1']) !!}
                            </div>
                            <div class="col-sm-3">
                                <label>Price</label>
                                {!! Form::text('child[0][price]', null, ['class' => 'form-control validate', 'id' => 'price', 'placeholder' => 'price', 'min' => '1']) !!}
                            </div>
                            <div class="col-sm-3 mt-4">
                                <button class="btn btn-primary addprice" type="button"><i class="fa fa-plus"
                                        aria-hidden="true"></i>
                                    Add More</button>
                            </div>
                        </div>
                </div>
            @endif
        </div>
        @endif
        @if ($age_group['infant']['allowed'] == 'Yes')
            <div class="tab-pane fade" id="infant" role="tabpanel" aria-labelledby="infant-tab">
                @if (isset($model) && count($model) > 0)
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($model->where('pricing_for', 'infant') as $key => $prices)
                        <div class="row my-3 infant-div">
                            {!! Form::hidden('infant[' . $i . '][id]', $prices->id ?? null, ['class' => 'pricing_id']) !!}
                            <div class="col-sm-3">
                                <label>Max Pax</label>
                                {!! Form::text('infant[' . $i . '][max_pax]', $prices->max_pax ?? null, ['class' => 'form-control validate', 'id' => 'max_pax', 'placeholder' => 'Max Pax', 'min' => '1']) !!}
                            </div>
                            <div class="col-sm-3">
                                <label>Price</label>
                                {!! Form::text('infant[' . $i . '][price]', $prices->price ?? null, ['class' => 'form-control validate', 'id' => 'price', 'placeholder' => 'price', 'min' => '1']) !!}
                            </div>
                            <div class="col-sm-3 mt-4">
                                @if ($i == 0)
                                    <button class="btn btn-primary addprice" type="button"><i class="fa fa-plus"
                                            aria-hidden="true"></i> Add More</button>
                                @else
                                    <button type="button" class="btn btn-primary removeprice"><i class="fa fa-minus"
                                            aria-hidden="true"></i> Remove</button>
                                @endif
                            </div>
                        </div>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                @else
                    <div class="row my-3 infant-div">
                        <div class="col-sm-3">
                            <label>Max Pax</label>
                            {!! Form::text('infant[0][max_pax]', null, ['class' => 'form-control validate', 'id' => 'max_pax', 'placeholder' => 'Max Pax', 'min' => '1']) !!}
                        </div>
                        <div class="col-sm-3">
                            <label>Price</label>
                            {!! Form::text('infant[0][price]', null, ['class' => 'form-control validate', 'id' => 'price', 'placeholder' => 'price', 'min' => '1']) !!}
                        </div>
                        <div class="col-sm-3 mt-4">
                            <button class="btn btn-primary addprice" type="button"><i class="fa fa-plus"
                                    aria-hidden="true"></i> Add More</button>
                        </div>
                    </div>
            </div>
        @endif
    </div>
    @endif
    </div>
    </div>
</div>
@endisset

@push('scripts')
    <script>
        $(document).on('click', '.addprice', function() {
            var another = $(this).parent().parent().clone();
            $(another).find('.addprice').removeClass('addprice').addClass('removeprice').html(
                '<i class="fa fa-minus" aria-hidden="true"></i> Remove').parent().removeClass('mt-4')
            $(another).find('input').val('');
            $(another).find('.pricing_id').remove()
            var div = $(this).parent().parent().hasClass('adult-div') ? 'adult' : ($(this).parent().parent()
                .hasClass('child-div') ? 'child' : 'infant');
            var count = $('.' + div + '-div').length;
            $(another).find('#max_pax').attr('name', div + '[' + count + '][max_pax]')
            $(another).find('#price').attr('name', div + '[' + count + '][price]')
            $(another).children('.col-sm-3').find('label').remove()
            $(another).insertAfter($('.' + div + '-div:last-child'));
        })

        $(document).on('click', '.removeprice', function() {
            if ($(this).hasClass('removeprice')) {
                if ($(this).parent().parent().find('.pricing_id').length > 0) {
                    var pricing_id = $(this).parent().parent().find('.pricing_id').val();
                    var activity_id = $('#activity_id').val()
                    var element = $(this);
                    var message = 'Removing this will affect the pricings totally and remove this pricings';
                    var data = {
                        ' _token': csrfToken(),
                        'activity_id': activity_id,
                        'pricing_id': pricing_id
                    }
                    var url = '{!! url("/services/activity/'+activity_id+'/prices/'+pricing_id+'") !!}';
                    AlertAndDelete(message, url, data, element);
                } else {
                    $(this).parent().parent().remove()
                }
            } else {
                $(this).parent().parent().remove();
            }
        })

        function AlertAndDelete(message, url, data, element) {
            swal({
                    title: 'Are you sure?',
                    text: message,
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: "#4385f4",
                    confirmButtonText: "Ok",
                    cancelButtonText: 'Cancel',
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    dangerMode: true,
                },
                function(confirm) {
                    if (confirm) {
                        $.ajax({
                            url: url,
                            type: 'delete',
                            data: data,
                            success: function(response) {
                                toasterMessage(response.type, response.message);
                                $(element).parent().parent().remove()
                            }
                        })
                    }
                })
        }
    </script>
@endpush
