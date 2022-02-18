{{-- @extends('agent::layouts.master')



<div class="row">
    <div class="col-md-10">
        <h4 class="">BANK DETAILS </h4>

    </div>
</div>
<div id="\agent_bank_details">
    <div class="row">

        @foreach ($bankDetails as $key => $bankData)
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header p-10">
                        Bank {{ $key + 1 }}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0 m-auto bl-4 border-secondary">
                            <p class="" id="\bank_details">
                                <label>Acc No.:</label>
                                {{ $bankData->account_number }}
                                <br>
                                <label>Name:</label> {{ $bankData->name }}
                                <br>
                                <label>IFSC:</label> {{ $bankData->ifsc }}
                                <br>
                                <label>IBAN:</label> {{ $bankData->iban }}
                                <br>
                                <label>Currency:</label>
                                {{ $bankData->currency }}
                            </p>
                            <footer class="blockquote-footer">Travel Door <cite title="Source Title">(
                                    {{ $agent->company_name }} )</cite></footer>
                        </blockquote>
                    </div>
                </div>
              
            </div>

        @endforeach
    </div>
</div>


<x-agents.profile.bank /> --}}
