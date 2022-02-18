<div class="box">
    <div class="box-header with-border">
        <h4 class="box-title">All Enquiries</h4>
        <h4 class="pull-right">Total Enquiries: {{$tours->count()}}</h4>
    </div>
    @if ($tours->count())
    <div class="box-body">
        <div class="table-responsive">
            <table class="table table-stripped datatables">
                <thead>
                    <th>Actions</th>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>Coontact no.</th>
                    <th>Email</th>
                    <th>Tour Type</th>
                    <th>No. of Pax</th>
                    <th>Assigned To</th>
                </thead>
                <tbody>
                    @foreach ($tours as $tour)
                    @php
                    if($tour->assigned_to){
                            $user = getSpecificUser($tour->assigned_to);
                            $assigned = $user->Fullname;
                        }
                        else {
                            $assigned = '<button class="btn btn-success" data-toggle="modal" data-target="#myModal" onclick="setEnquiryId('.$tour->tour_inquiry_id.')">Assign to</button>';
                        }
                    @endphp
                    <tr>
                        <td><a href="" class="action"><i class="fa fa-eye" aria-hidden="true"></i></a><a href="" class="action"><i class="fa fa-pencil" aria-hidden="true"></i></a><a href="" class="action"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                        <td>{!!$tour->tour_inquiry_id!!}</td>
                        <td>{!!$tour->tour_client_name!!}</td>
                        <td>{!!$tour->tour_client_phn!!}</td>
                        <td>{!!$tour->tour_client_email!!}</td>
                        <td>{!!$tour->tour_type!!}</td>
                        <td>{!!($tour->tour_adult_count)? (int)$tour->tour_adult_count + (int)$tour->tour_child_count. '(' . $tour->tour_adult_count . 'Adult, '.$tour->tour_child_count .'Kids )' : 'N/A' !!}</td>
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
