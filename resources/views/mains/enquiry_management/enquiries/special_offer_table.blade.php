<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">All Enquiries</h4>
        <h4 class="pull-right">Total Enquiries: {{$specialOffers->count()}}</h4>
    </div>
    @if ($specialOffers->count())
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-stripped datatables">
                <thead>
                    <th>Actions</th>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>Coontact no.</th>
                    <th>Email</th>
                    <th>address</th>
                    <th>Additional Notes</th>
                    <th>Assigned To</th>
                </thead>
                <tbody>
                    @foreach ($specialOffers as $offer)
                    @php
                        $country = getSpecificCountry($offer->country);
                        if($offer->assigned_to){
                            $user = getSpecificUser($offer->assigned_to);
                            $assigned = $user->Fullname;
                        }
                        else {
                            $assigned = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal"  onclick="setEnquiryId('.$offer->id.')">Assign to</button>';
                        }
                        if($offer->additional_notes){
                            $notes = (strlen($offer->additional_notes) > 30) ? substr($offer->additional_notes, 0, 30) . '...' : $offer->additional_notes;
                        }
                        else{
                            $notes = 'N/A';
                        }
                    @endphp
                    <tr>
                        <td><a href="" class="action"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="" class="action"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="" class="action"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        <td>{{$offer->id}}</td>
                        <td>{{$offer->fullname}}</td>
                        <td>{{$offer->phone}}</td>
                        <td>{{$offer->email}}</td>
                        <td>{{$offer->address}}</td>
                        <td>{{$notes}}</td>
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
