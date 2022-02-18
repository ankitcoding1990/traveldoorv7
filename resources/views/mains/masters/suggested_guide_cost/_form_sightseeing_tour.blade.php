<div class='col-md-12'>
    <div class='row'>
        <div class='col-md-4'>
            <p >SightSeeing Tours</p>
        </div>
    <div class='col-md-8'>
        <div class='row'>
            <div class='col-md-5'>
                <p>Vehicle Type</p>
            </div>
            <div class='col-md-3 cost '>
                <p>ucfirst($src) Cost</p>
            </div>
            <div class='col-md-3'>
                <p>Suggested Cost</p>
            </div>
            <div class='col-md-1'>
                Currency
            </div>
        </div>
    </div>
</div>
@foreach ($fetch_sightseeing as $sightseeing)
    <div class='row'>
        <div class='col-md-4'>
            <input type='hidden' name='tour_name[]' value='{{$sightseeing->sightseeing_id}}'>
            <input type='text' class='form-control' value='{{$sightseeing->sightseeing_tour_name}}' readonly='readonly'>
        </div>
    <div class='col-md-8'>

    @foreach ($fetch_vehicle_type as $vehcile_type)

    <div class='row type type_{{$vehcile_type->vehicle_type_id}}' style='display:none;'>
        <div class='col-md-5'><input type='hidden' name='tour_vehiclename[{{$sightseeing->sightseeing_id - 1}}][]' value='{{$vehcile_type->vehicle_type_id}}'>
            <input type='text' class='form-control' value='{{$vehcile_type->vehicle_type_name}}' readonly='readonly'>
        </div>
        @php
            $suggested_vehicle_cost = suggestedVehicleCost($sightseeing->sightseeing_id,$vehcile_type->vehicle_type_id);
        @endphp


       <div class='col-md-3 cost '><input type='text' class='form-control tour_guide_cost' id='tour_guide_cost__{{$sightseeing->sightseeing_id - 1}}__{{$vehcile_type->vehicle_type_id}}' name='tour_guide_cost[{{$sightseeing->sightseeing_id - 1}}][]' value='0' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)'> </div>


      @if ($src == "driver") {
        @if ($suggested_vehicle_cost)
            @php
                $suggested_vehicle_price = $suggested_vehicle_cost->suggested_vehicle_cost ?? 0;
            @endphp
        @else
            @php
                $suggested_vehicle_price = 0;
            @endphp
        @endif

        <div class='col-md-3'><input type='text' id='tour_suggested_guide_cost__{{$sightseeing->sightseeing_id - 1}}__{{$vehcile_type->vehicle_type_id}}' class='form-control scost' name='tour_suggested_cost[{{$sightseeing->sightseeing_id - 1}}][]' value='{{round($suggested_vehicle_price * $con)}}' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)' readonly='readonly'></div>
      @endif

      @if ($src == "guide")
        @if ($suggested_vehicle_cost)
            @php
                $suggested_guide_price = $suggested_vehicle_cost->suggested_guide_cost ?? 0;
            @endphp
         @else
          $suggested_guide_price = 0;
        @endif

         <div class='col-md-3'><input type='text' class='form-control scost' id='tour_suggested_guide_cost__{{$sightseeing->sightseeing_id - 1}}__{{$vehcile_type->vehicle_type_id}}' name='tour_suggested_cost[{{$sightseeing->sightseeing_id - 1}}][]' value='{{round($suggested_guide_price * $con)}}' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)' readonly='readonly'></div>
      @endif
      <div class='col-md-1'>{{$currency}}</div></div>
      @endforeach
  <br></div>
  </div>
@endforeach
