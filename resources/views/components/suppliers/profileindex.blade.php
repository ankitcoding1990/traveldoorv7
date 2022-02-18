
<style>
    #operating_weekdays{
        font-weight: bold;
    }
</style>
<div class="row">
        <div class="col-md-10 col-7 text-center">
            <h4 class="">Supplier Details </h4>
        </div>
        @isset($isSupplier)
            <div class="col-md-2 col-5">
                <a class="btn btn-sm btn-info float-right" href="{{route('supplier.profile.edit',encrypt($supplier->id))}}" ><i class="fa fa-pencil"></i> Edit Profile</a> 
            </div>
        @endisset
    <hr>
</div>
<div class="tab-pane fade show active" id="nav-basic-details" role="tabpanel"
                aria-labelledby="nav-basic-details-tab">
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="agent_name"><strong>Supplier NAME
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="agent_name">
                                    {{ ucwords($supplier->name) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="company_name"><strong>COMPANY NAME
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="company_name">
                                    {{ ucwords($supplier->company_name) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="company_email"><strong>EMAIL ID
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="company_email">
                                    {{ strtolower($supplier->email) }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="company_contact"><strong>CONTACT NUMBER
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="company_contact">
                                    {{ $supplier->company_contact }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="company_fax"><strong>FAX ADDRESS
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="company_fax">
                                    {{ $supplier->company_fax }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="address"><strong>ADDRESS :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="address">
                                    {{ $supplier->address }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="agent_country"><strong>COUNTRY
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="agent_country">
                                    {{ $country->country_name }}
                                    ({{ $country->country_abbr }})</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="agent_city"><strong>CITY :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="agent_city">
                                    {{ $city->name }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="corporate_reg_no"><strong>CORPORATE REG NO:</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="corporate_reg_no">
                                    {{ $supplier->corporate_reg_no }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="corporate_desc"><strong>CORPORATE DESCRIPTION
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="corporate_desc">
                                    {{ $supplier->corporate_desc }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="skype_id"><strong>SKYPE ID :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="skype_id">
                                    {{ $supplier->skype_id }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="operating_hrs_from"><strong>OPERATING HOURS
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="operating_hrs_from">
                                    {{ $supplier->operating_hrs_from }} To
                                    {{ $supplier->operating_hrs_to }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="operating_weekdays"><strong>WORKING DAYS
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="operating_weekdays">
                                    @foreach ($supplier->operating_weekdays as $weekName => $value)
                                        @if ($value == 'yes')
                                            {{ ucfirst($weekName) }},
                                        @endif
                                    @endforeach
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="operating_weekdays"><strong>BlackOut DAYS
                                        :</strong></label>
                            </div>
                            <div class="col-md-9">
                                <p class="" id="operating_weekdays">
                                    @php
                                        $blackoutDays = $supplier->blackout_dates_array;
                                        $color_loop = 0; 
                                    @endphp
                                    @if ($blackoutDays)
                                        <div class="row">
                                            <div class="col-md-12" style="display: contents;">
                                                @foreach ($blackoutDays as $days => $value)
                                                @php
                                                    $service_bg_color = ['info', 'primary', 'danger', 'warning', 'secondary'];
                                                    if ($color_loop > count($service_bg_color) - 1) {
                                                        $color_loop = 0;
                                                    }
                                                @endphp
                                                <div class="col-md-3">
                                                <h5> <span class="badge badge-{{$service_bg_color[$color_loop]}}">{{ date("j-F-Y",strtotime($value)) }}</span> </h5> </div>
                                                    @php
                                                        $color_loop++;
                                                    @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                   
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ asset('assets/uploads/supplier_logos/') }}/{{ $supplier->logo }}"
                                        target="_blank"><img class="card-img-top"
                                            src="{{ asset('assets/uploads/supplier_logos/') }}/{{ $supplier->logo }}"
                                            style=""> <strong class="card-title text-center d-block">Logo</strong></a>
                                           
                                  </div>                                                               
                            </div>
                            <div class="col-md-12 mt-5">
                                <div class="card" style="width: 18rem;">
                                    <a href="{{ asset('assets/uploads/supplier_certificates/') }}/{{ $supplier->certificate_corp }}"
                                        target="_blank"><img
                                            src="{{ asset('assets/uploads/supplier_certificates/') }}/{{ $supplier->certificate_corp }}"
                                            style=""> <strong class="card-title text-center d-block">Certificate</strong></a>
                                           
                                  </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-10">
                        <div class="col-md-12">
                            <h4 class="box-header with-border"
                                style="padding: 10px;border-color: #c3c3c3;">
                                <i class="fa fa-minus-circle" id="country_operation"></i>
                                COUNTRY OF
                                OPERATION
                            </h4>
                        </div>
                    </div>
                    <div id="country_operation_details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($oprCountries as $key => $countryData)
                                        <div class="col-md-6">
                                            <label
                                                for="country_name"><strong>COUNTRY {{ $key+1 }} : </strong></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="" id="country_name" data-toggle="tooltip" data-placement="right" title="Code : {{ $countryData->country_code }}">
                                                <strong>{{ $countryData->country_name }}</strong>
                                                <span>({{ $countryData->country_abbr }})</span></span>
                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <h4 class="box-header with-border"
                                style="padding: 10px;border-color: #c3c3c3;">
                                <i class="fa fa-minus-circle" id="currency_operation"></i>
                                AGENT
                                CURRENCY
                            </h4>
                        </div>
                    </div>
                    <div id="currency_operation_details">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    @foreach ($oprCurrency as $key => $currencyData)
                                        <div class="col-md-6">
                                            <label for="currency_name"><strong>CURRENCY {{ $key+1 }} :
                                                </strong></label>
                                        </div>
                                        <div class="col-md-6">
                                            <span class="" id="currency_name" data-toggle="tooltip" title="Code : {{ $currencyData->symbol }}" data-placement="right">
                                                <strong>{{ $currencyData->name }}</strong> <span>({{ $currencyData->code }})</span></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    <!-- Modal -->
<div class="modal fade" id="suplierProfileModel" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier Profile </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="suplierProfileModelBody">
                
            </div>
            
        </div>
    </div>
</div>