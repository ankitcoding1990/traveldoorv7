<div class='container my-1'>
    <div class='row my-2' style="font-weight: bolder; font-size: 1.2rem">
        <div class='col-md-4'>
            @if($transfer_type=='to-airport')
                <p >To Airport</p>
            @else
                <p >To City</p>
            @endif
        </div>
        <div class='col-md-8'>
            <div class='row'>
                <div class='col-md-6'>
                    <p>Vehicle Type</p>
                </div>
                <div class='col-md-4'>
                    <p>Suggested Cost</p>
                </div>
                <div class='col-md-2'>
                    Currency
                </div>
            </div>
        </div>
    </div>
    {{-- @if($transfer_type=='to-airport') --}}
        @foreach ($data as $transfer)
        @php
            if($transfer_type=='to-airport' || $transfer_type=='to-border' || $transfer_type=='to-railway'){
                $vehicle_type_array_index = $transfer->master_id;
            }else{
                $vehicle_type_array_index = $transfer->id;
            }
        @endphp
        <div class='row'>
            <div class='col-md-4'>
                @if($transfer_type=='to-airport' || $transfer_type=='to-border' || $transfer_type=='to-railway')
                    <input type='hidden' name='transfer_to[]' value='{{$transfer->master_id}}'>
                    <input type='text' class='form-control' value='{{$transfer->master_name}}' readonly='readonly'>
                @else
                    <input type='hidden' name='transfer_to[]' value='{{$transfer->id}}'>
                    <input type='text' class='form-control' value='{{$transfer->name}}' readonly='readonly'>
                @endif
            </div>
            <div class='col-md-8'>
            @foreach ($vehicles as $vehicle_type)
            <div class='row type type_{{$vehicle_type->vehicle_type_id}}' style='display:none;'>
                <div class='col-md-6'>
                    <input type='hidden' name='transfer_vehiclename[{{$vehicle_type_array_index}}][]' value='{{$vehicle_type->vehicle_type_id }}'>
                    <input type='text' class='form-control' value='{{$vehicle_type->vehicle_type_name }}' readonly='readonly'>
                </div>
                @foreach ($suggestedPrice as $suggested_price)
                @if ($transfer_type=='to-airport' || $transfer_type=='to-border' || $transfer_type=='to-railway')
                    @if ($suggested_price->from_city_airport == $transfer_from && $suggested_price->to_city_airport == $transfer->master_id && $suggested_price->transfer_vehicle_type_id ==  $vehicle_type->vehicle_type_id)
                    <?php $price = $suggested_price->suggested_transfer_vehicle_cost ?>
                    @endif
                @else
                    @if ($suggested_price->from_city_airport == $transfer_from && $suggested_price->to_city_airport == $transfer->id && $suggested_price->transfer_vehicle_type_id ==  $vehicle_type->vehicle_type_id)
                    <?php $price = $suggested_price->suggested_transfer_vehicle_cost ?>
                    @endif
                @endif
                @endforeach
                <div class='col-md-4'>
                    <input type='text' id='transfer_suggested_cost__{{$vehicle_type_array_index}}__{{$vehicle_type->vehicle_type_id}}' class='form-control scost' name='transfer_suggested_cost[{{$vehicle_type_array_index}}][]' value='{{$price ?? 0}}' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)' readonly='readonly'>
                </div>
                <div class='col-md-2'>{{$currency}}</div>
            </div>

            @endforeach
            </div>
        </div> <div><br></div>
        @endforeach
    {{-- @else
        @foreach ($fetch_transfer as $transfer)
        <div class='row'>
            <div class='col-md-4'>
                <input type='hidden' name='tour_name[]' value='{{$transfer->id}}'>
                <input type='text' class='form-control' value='{{$transfer->name}}' readonly='readonly'>
            </div>
            <div class='col-md-8'>
            @foreach ($fetch_vehicle_type as $vehicle_type)
            <div class='row type type_{{$vehicle_type->vehicle_type_id}}' style='display:none;'>
                <div class='col-md-5'>
                    <input type='hidden' name='tour_vehiclename[][]' value='{{$vehicle_type->vehicle_type_id }}'>
                    <input type='text' class='form-control' value='{{$vehicle_type->vehicle_type_name }}' readonly='readonly'>
                </div>
                <div class='col-md-3'>
                    <input type='text' id='tour_suggested_guide_cost__' class='form-control scost' name='tour_suggested_cost[][]' value='' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)' readonly='readonly'>
                </div>
                <div class='col-md-1'>{{$currency}}</div>
            </div>

            @endforeach
            </div>
        </div> <div><br></div>
        @endforeach
    @endif --}}
</div>
