@extends('layouts.main')
@push('style')
    <style>
        td > a{
            padding: 4px;
        }
        td > a{
            font-size: larger;
        }
        td > a + a::before{
            content: "|  ";
            color: #ddd;
        }
        th:first-child{
            width: 120px !important;
        }
        th:last-child{
            width:100px !important;
        }
        th, td {
           white-space: nowrap;
        }
    </style>
@endpush
@section('title','Enquiry Management')

@section('main')
@php
    $rights  = rights();
@endphp

@if($rights['add']==1 || $rights['view']==1)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                @include('mains.enquiry_management.enquiries.filter');
                <div class="my-2">
                    <a href="{{route('enquiries.create')}}" class="btn btn-rounded btn-warning"><i class="fa fa-plus" aria-hidden="true"></i> Create New Enquiry</a>
                <a  class="btn btn-rounded btn-success pull-right"><i class="fa fa-list-alt" aria-hidden="true"></i> Operators stats</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 table-div">
    </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Select Operator</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Assign to:</label>
                    <input type="hidden" name="enquiry_id" id="enquiry_id">
                    {!! Form::select('users', getUsersList(), null, ['class' => 'form-control','id' => 'users']) !!}
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-info" data-dismiss="modal" id="assign_to">Assign</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@else
    <h4 class="text-danger">No rights to access this page</h4>
@endif

@endsection
@push('scripts')
<script>
    $('.datepicker').datepicker({
        autoclose: true,
        autoSize: true,
        todayHighlight: true,
        format: 'yyyy-mm-dd',
        defaultDate: new Date(),
    })

    $(document).on('change','#from_date, #to_date, #enquiry, #prospect, #status, #enquiry_type, #country, #assignee', function(){
        getTable()
    })

    function getTable(){
        var fromDate = $('#from_date').val()
        var toDate = $('#to_date').val()
        var table;
        if(fromDate.trim() == ""){
            return false;
        }
        if(toDate.trim() == ""){
            return false;
        }
        var enquiry = $('#enquiry').val()
        if(enquiry == 0){
            $('.prospect').show()
            $('.enquiry_type').show()
            $('.countries').show()
            ajaxForEnquiries(fromDate,toDate,enquiry)
        }
        else if(enquiry == 1){
            $('.countries').show()
            $('.prospect').hide()
            $('.enquiry_type').hide()
            ajaxForSpecialOffer(fromDate,toDate,enquiry)
        }
        else{
            $('.countries').hide()
            $('.prospect').hide()
            $('.enquiry_type').hide()
            ajaxForTour(fromDate,toDate,enquiry)
        }
    }

    function ajaxForEnquiries(fromDate,toDate,enquiry){
        var prospect = $('#prospect').val()
        var status = $('#status').val()
        var enquiry_type = $('#enquiry_type').val()
        var country = $('#country').val()
        var assignee = $('#assignee').val()
        $.ajax({
            type: 'get',
            url: "{{route('getEnquiryTable')}}",
            data: {
                'prospect':prospect,
                'status':status,
                'enquiry_type':enquiry_type,
                'country':country,
                'assignee':assignee,
                'fromDate':fromDate,
                'toDate':toDate,
            },
            success: function(response){
                $('.table-div').html(response)
                $('.datatables').DataTable({responsive: true});
            }
        })
    }

    function ajaxForSpecialOffer(fromDate,toDate,enquiry){
        var country = $('#country').val()
        var assignee = $('#assignee').val()
        var status = $('#status').val()
        $.ajax({
            type: 'get',
            url: "{{route('getSpecialOfferTable')}}",
            data: {
                'status':status,
                'country':country,
                'assignee':assignee,
                'fromDate':fromDate,
                'toDate':toDate,
            },
            success: function(response){
                $('.table-div').html(response)
                $('.datatables').DataTable({responsive: true});
            }
        })
    }
    function ajaxForTour(fromDate,toDate,enquiry){
        var assignee = $('#assignee').val()
        var status = $('#status').val()
        $.ajax({
            type: 'get',
            url: "{{route('getTourTable')}}",
            data: {
                'status':status,
                'assignee':assignee,
                'fromDate':fromDate,
                'toDate':toDate,
            },
            success: function(response){
                $('.table-div').html(response)
                $('.datatables').DataTable({responsive: true});
            }
        })
    }
    function setEnquiryId(id){
        $('#enquiry_id').val(id);
    }
    $(document).on('click','#assign_to',function(){
        var users = $('#users').val();
        var enquiry = $('#enquiry').val();
        var enquiry_id = $('#enquiry_id').val();
        $.ajax({
            type: 'get',
            url:'{{route("assignTo")}}',
            data: {'users' : users,
                    'enquiry' : enquiry,
                    'enquiry_id': enquiry_id},
            success: function(response){
                swal(response[1],response[0],response[1]);
                getTable()
            }
        })
    })
</script>
@endpush
