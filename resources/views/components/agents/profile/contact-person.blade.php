{{-- <div class="row mb-10">
    <div class="col-md-10">
        <h4 class="">CONTACT PERSONS</h4>
    </div>
    <div class="col-md-2 "><button class="btn btn-sm btn-info float-right" data-toggle="modal"
            data-target="#exampleModal"><i class="fa fa-phone"></i> Add Contact</button> </div>
    <hr>
</div>
<div id="\agent_contact_details">
    <div class="row">
        @foreach ($contactPerson as $key => $contactData)
            <div class="col-md-4 col-12">
                <div class="card">
                    <div class="card-header p-10">
                        Contact {{ $key + 1 }}
                    </div>
                    <div class="card-body ">
                        <blockquote class="blockquote mb-0 m-auto bl-4 border-secondary">
                            <p class="" id="\contact_details">
                                <label>Name:</label> {{ $contactData->name }}
                                <br>
                                <label>Number:</label> {{ $contactData->number }}
                                <br>
                                <label>Email ID:</label>{{ $contactData->email }}

                            </p>
                            <footer class="blockquote-footer">Travel Door <cite title="Source Title">(
                                    {{ $agent->company_name }} )</cite></footer>
                        </blockquote>
                    </div>
                </div>
            </div>
            <!-- /.card -->

        @endforeach
    </div>
</div> --}}