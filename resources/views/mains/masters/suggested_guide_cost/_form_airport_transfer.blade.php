<div class='col-md-12'>
        <div class='row'>
            <div class='col-md-3'>
                <p>Airports</p>
            </div>
        <div class='col-md-9'>
            <div class='row'>
                <div class='col-md-3'>
                    <p>Vehicle Type</p>
                </div>
                <div class='col-md-2 cost'>
                    <p> {{ucfirst($src)}} Inside City Cost</p>
                </div>
                <div class='col-md-2 cost'>
                    <p> {{ucfirst($src)}} Outside City Cost</p>
                </div>
                @if ($src == "guide")
                    <div class='col-md-2'>
                    <p> {{ucfirst($src)}} Suggested Inside City Cost</p>
                    </div>
                    <div class='col-md-2'>
                    <p> {{ucfirst($src)}} Suggested Outside City Cost</p>
                    </div>
                    <div class='col-md-1'>
                    <p>Currency</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @foreach ($fetch_airports as $airports)
        <div class='row'>
            <div class='col-md-3'>
                <input type='hidden' name='airport_name[]' value='{{$airports->airport_master_id}}'>
                <input type='text' class='form-control' value='{{$airports->airport_master_name}}' readonly='readonly'>
            </div>
            <div class='col-md-9'>

        @foreach ($fetch_vehicle_type as $vehcile_type)
            <div class='row'>
                <div class='col-md-3'><input type='hidden' name='airport_vehicle_name[{{$airports->airport_master_id - 1}}][]' value='{{$vehcile_type->vehicle_type_id}}'>
                    <input type='text' class='form-control' value='{{$vehcile_type->vehicle_type_name}}' readonly='readonly'>  </div>  <div class='col-md-2 cost'>
                    <input type='text' class='form-control' name='airport_guide_inside_cost[{{$airports->airport_master_id - 1}}][]' value='0' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)'> </div>
                <div class='col-md-2 cost'>
            <input type='text' class='form-control' name='airport_guide_outside_cost[{{$airports->airport_master_id - 1}}][]' value='0' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)'> </div>

            @php
                $suggested_guide_cost = suggestedGuideCost($airports->airport_master_id,$vehcile_type->vehicle_type_id);
            @endphp

        @if ($suggested_guide_cost)
            @php
                $guide_suggested_outside_city_cost = $suggested_guide_cost->guide_suggested_outside_city_cost;
                $guide_suggested_inside_city_cost = $suggested_guide_cost->guide_suggested_inside_city_cost;
            @endphp
        @else
            @php
                $guide_suggested_outside_city_cost = 0;
                $guide_suggested_inside_city_cost = 0;
            @endphp
        @endif
          @if ($src == "guide")
            <div class='col-md-2'>
                <input type='text' class='form-control scost' name='airport_guide_suggested_inside_cost[{{$airports->airport_master_id - 1}}][]' value='{{round($guide_suggested_inside_city_cost * $con)}}'  onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)' readonly='readonly'> </div>
            <div class='col-md-2'>
                <input type='text' class='form-control scost' name='airport_guide_suggested_outside_cost[{{$airports->airport_master_id - 1}}][]' value='{{round($guide_suggested_outside_city_cost * $con)}}' onkeypress='javascript:return validateNumber(event)'  onpaste='javascript:return validateNumber(event)' readonly='readonly'> </div>
          @endif



              <div class='col-md-1'>
              <p>{{$currency}}</p>
              </div>
              </div>
        @endforeach

          <br></div>
          </div>

    @endforeach
    @if (count($fetch_airports) <= 0)
        <div class='row'><p class='text-center'><b>No Airports Available</b></p></div>
    @endif
</div>
