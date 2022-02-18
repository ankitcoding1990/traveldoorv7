<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">All Enquiries</h4>
        <h4 class="pull-right">Total Enquiries: {{$enquiries->count()}}</h4>
    </div>
    @if ($enquiries->count())
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-stripped datatables">
                <thead>
                    <th>Actions</th>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>Coontact no.</th>
                    <th>Email</th>
                    <th>No. of Pax</th>
                    <th>Destination</th>
                    <th>Assigned To</th>
                </thead>
                <tbody>
                    @foreach ($enquiries as $enquiry)
                    @php
                        $country = getSpecificCountry($enquiry->departure_country);
                        if($enquiry->assigned_to){
                            $user = getSpecificUser($enquiry->assigned_to);
                            $assigned = $user->Fullname;
                        }
                        else {
                            $assigned = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="setEnquiryId('.$enquiry->enq_id.')">Assign to</button>';
                        }

                    @endphp
                    <tr>
                        <td><a href="" class="action"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="" class="action"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="" class="action"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        <td>{{$enquiry->enq_id}}</td>
                        <td>{{$enquiry->customer_name}}</td>
                        <td>{{$enquiry->customer_contact ?? 'N/A'}}</td>
                        <td>{{$enquiry->customer_email ?? 'N/A'}}</td>
                        <td>{{($enquiry->no_of_adults != 0 || $enquiry->no_of_adults != "") ? (int)$enquiry->no_of_adults + (int)$enquiry->no_of_kids  .'('.$enquiry->no_of_adults .' Adult, '. $enquiry->no_of_kids.' Kids)' : '0' }}</td>
                        <td>{{$country->country_name ?? 'N/A'}}</td>
                        <td>{!!$assigned!!}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
            <center><p class="text-secondary">No Enquiries Found!</p></center>
        @endif
</div>

