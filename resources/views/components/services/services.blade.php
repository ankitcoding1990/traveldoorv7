@php
    $services = $agent->services;
@endphp
<div class="row mb-10">
    <div class="col-md-12 text-center">
        <h4 class="">SERVICE
            TYPE
            DETAILS </h4>
        <hr>
    </div>
</div>

{{-- @dd($agent) --}}

<div id="\service_type_details">
    <div class="row">
        @php
           // $services = getAgentServices($servicefor,$type);
            $color_loop = 0;
        @endphp
        @foreach ($services as $key => $service)

            @php
                $service_bg_color = ['info', 'primary', 'danger', 'warning', 'secondary'];
                if ($color_loop > count($service_bg_color) - 1) {
                    $color_loop = 0;
                }
            @endphp
            <div class="col-xl-3 col-12">
                <div class="box box-body bl-4 border-{{ $service_bg_color[$color_loop] }} pull-up">
                    <strong class=""> {{ ucwords($service->name) }}</strong>
                    @if ($service->markup)
                        <div class="d-flex justify-content-between">
                            <span class=""> <small>Markup</small>( {{ ucwords($service->markup) }} %)</span>
                        </div>
                    @endif
                </div>
            </div>
            @php
                $color_loop++;
            @endphp
        @endforeach



    </div>
</div>
