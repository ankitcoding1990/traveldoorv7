<div class="row mb-10">
    <div class="col-sm-12 col-md-12 col-lg-6">
        @if ($isAdmin)
            @php
                $serviceData = activeServices();
            @endphp
        @else
            @php
                $serviceData = activeServices()->whereIn('name', ['Hotel', 'Itinerary']);
            @endphp
        @endif
        @foreach ($serviceData as $service)
            @php
                $agentServiceIdCheckbox = 'agent' . $service->id . 'checkbox';
            @endphp
            <div class="serviceitem">
                <div class="form-group">
                    <input class="form-control agent_service_types" type="checkbox" name="service_ids[]"
                        value="{{ $service->id }}" id="{{ $agentServiceIdCheckbox }}">
                    <label class="font-weight-bold"
                        for="{{ $agentServiceIdCheckbox }}">{{ ucwords($service->name) }}</label>
                </div>
                <blockquote class="blockquote" style="display:none">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold" style="border: none">Markup </span>
                        </div>
                        <input type="text" class="form-control isNumberMarkup"
                            placeholder="Enter {{ ucwords($service->name) }}" style="width: 25px!important"
                            name="markup[]">

                        <div class="input-group-append">
                            <span class="input-group-text">% </span>
                        </div>
                    </div>
                </blockquote>
            </div>
        @endforeach

        <input name="select_all" type="checkbox" id="select_all">
        <label for="select_all">Select All</label>
    </div>
</div>
@push('scripts')
    <script>
        $(document).on('input', '.isNumberMarkup', function(event) {
            this.value = this.value.replace(/[^0-9\.]/g, '');

        });
        $(document).on('change', '.agent_service_types', function() {
            if (this.checked) {
                $(this).parent('div').siblings('blockquote').show();
                $(this).parent('div').siblings('blockquote').find('input').focus();

            } else {
                $(this).parent('div').siblings('blockquote').hide();
                $(this).parent('div').siblings('blockquote').find('input').val('');
            }

        })
    </script>
@endpush
