@push('style')
    <style>
        label {
            white-space: nowrap;
        }

    </style>
@endpush
<div class="row">
    <div class="col-sm-12">
        <div class="row border-bottom py-2">
            <h3>Reason to book the hotel</h3>
            @if (isset($hotel) && !empty($hotel->reasons_to_book))
                @foreach ($hotel->reasons_to_book as $key => $reasons)
                    <div class="col-sm-6 cloneReason">
                        <div class="row mx-2">
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="reasons_to_book">Reason 1</label>
                                    {!! Form::text('reasons_to_book[]', $reasons ?? null, ['class' => 'form-control validate', 'id' => 'reasons_to_book', 'placeholder' => 'Reason to book']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4 mt-30 pl-0">
                                @if ($key == 0)
                                    <button class="btn btn-primary addReason" type="button"><i class="fa fa-plus"
                                            aria-hidden="true"></i>Add More</button>
                                @else
                                    <button class="btn btn-primary removeReason" type="button"><i class="fa fa-minus"
                                            aria-hidden="true"></i>Remove</button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-sm-6 cloneReason">
                    <div class="row mx-2">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <label for="reasons_to_book">Reason 1</label>
                                {!! Form::text('reasons_to_book[]', null, ['class' => 'form-control validate', 'id' => 'reasons_to_book', 'placeholder' => 'Reason to book']) !!}
                            </div>
                        </div>
                        <div class="col-sm-4 mt-30 pl-0">
                            <button class="btn btn-primary addReason" type="button"><i class="fa fa-plus"
                                    aria-hidden="true"></i>Add More</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <div class="col-sm-12">
        <h3>Other Policies <span class="small">(Mention some policies for your customers)</span></h3>
        <div class="row border-bottom py-2">
            @if (isset($hotel) && !empty($hotel->other_policies))
                @foreach ($hotel->other_policies as $key => $policy)
                    <div class="col-sm-6 clonePolicy my-2">
                        <div class="row mx-2">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="policy_name">Name</label>
                                    {!! Form::text('other_policies['.$key.'][name]', $policy['name'] ?? null, ['class' => 'form-control validate', 'id' => 'policy_name', 'placeholder' => 'Policy Name']) !!}
                                </div>
                                <div class="form-group">
                                    <label for="policies_description">Description</label>
                                    {!! Form::textarea('other_policies['.$key.'][description]', $policy['description'] ?? null, ['class' => 'form-control validate policy_description', 'id' => 'policy_description', 'placeholder' => 'Description', 'rows' => '3']) !!}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button class="btn btn-primary mx-auto addPolicy" type="button"><i
                                        class="fa fa-plus" aria-hidden="true"></i>Add More</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-sm-6 clonePolicy my-2">
                    <div class="row mx-2">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="policy_name">Name</label>
                                {!! Form::text('other_policies[0][name]', null, ['class' => 'form-control validate', 'id' => 'policy_name', 'placeholder' => 'Policy Name']) !!}
                            </div>
                            <div class="form-group">
                                <label for="policies_description">Description</label>
                                {!! Form::textarea('other_policies[0][description]', null, ['class' => 'form-control validate policy_description', 'id' => 'policy_description', 'placeholder' => 'Description', 'rows' => '3']) !!}
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <button class="btn btn-primary mx-auto addPolicy" type="button"><i class="fa fa-plus"
                                    aria-hidden="true"></i>Add More</button>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @php
        if (isset($hotel)) {
            $hotelAmenities = $hotel->amenity->pluck('amenity_id')->toArray();
            $hotelSubAmenities = $hotel->amenity->pluck('sub_amenity_id')->toArray();
        }
    @endphp
    <div class="col-sm-12">
        <h3>Amenities</h3>
        <div class="row">
            @foreach ($amenities as $key => $amenity)
                <div class="col-sm-4">
                    {!! Form::checkbox('hotel[' . $key . '][amenity]', $amenity->id, isset($hotelAmenities) && in_array($amenity->id, $hotelAmenities) ? 'checked' : null, ['class' => 'form-control amenity', 'id' => 'amenity_' . $key]) !!}
                    <label for="{{ 'amenity_' . $key }}">{{ $amenity->amenities_name }}</label>
                    <div class="col-md-12 ps-4" style="display: {{ isset($hotelAmenities) && in_array($amenity->id, $hotelAmenities) ? 'block' : 'none' }}">
                        <div class="row">
                            @foreach ($amenity->sub_amenities as $k => $subAmenity)
                                <div class="col-sm-6">
                                    {!! Form::checkbox('hotel[' . $key . '][sub_amenity][' . $k . ']', $subAmenity->id, isset($hotelSubAmenities) && in_array($subAmenity->id, $hotelSubAmenities) ? 'checked' : null, ['class' => 'form-control', 'id' => 'sub_amenity_' . $key . $k]) !!}
                                    <label
                                        for="{{ 'sub_amenity_' . $key . $k }}">{{ $subAmenity->sub_amenities_name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).on('click', '.addReason', function() {
            var clone = $(this).parent().parent().parent().clone();
            var index = $('.cloneReason').length;
            $(clone).children().children('div').find('.addReason').addClass('removeReason').removeClass('addReason')
                .html('<i class="fa fa-minus" aria-hidden="true"></i> Remove')
            $(clone).find('input').val('')
            $(clone).children().children('div').find('label').html(`Reason ${index+1}`);
            $(clone).insertAfter($('.cloneReason:last-child'));
        })

        $(document).on('click', '.addPolicy', function() {
            var clone = $(this).parent().parent().parent().clone();
            var index = $('.clonePolicy').length
            $(clone).children().children('div').find('.addPolicy').addClass('removePolicy').removeClass('addPolicy')
                .html('<i class="fa fa-minus" aria-hidden="true"></i> Remove')
            $(clone).children('div').find('#policy_name').attr('name', 'other_policies[' + index + '][name]')
            $(clone).children('div').find('#policy_description').attr('name', 'other_policies[' + index +
                '][description]')
            $(clone).children().find('input').val('')
            $(clone).children().find('textarea').val('')
            $(clone).insertAfter($('.clonePolicy:last-child'))
        })

        $(document).on('click', '.removeReason, .removePolicy', function() {
            $(this).parent().parent().parent().remove()
        })

        $(document).on('click', '.amenity', function() {
            $(this).siblings('div').animate(2).toggle()
        })
    </script>
@endpush
