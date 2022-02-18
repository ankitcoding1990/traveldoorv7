@extends('layouts.main')
@push('style')
    <style>
        th[title=Action]{
            width: 235px !important;
        }
        td{
            padding: 10px 5px !important;
        }
    </style>
@endpush
@section('title','Coupon Management')

@section('main')

@if(auth()->user()->hasViewPermission($routeName))
    @isset($dataTable)
    <div class="row" id="table_div">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">All Coupons</h4>
                    @if(auth()->user()->hasAddPermission($routeName))
                        <a href="{{route('coupon.create')}}" class="btn btn-primary mr-10 pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Coupon</a>
                    @endif
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        {!! $dataTable->table() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endisset
@else
    <h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection

@push('scripts')
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset
@if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
  @php
      session()->forget('status');
  @endphp
@endif
<script>
    function delColumn(id){
        var token      = $("meta[name='csrf-token']").attr("content");
        var text       = "Once deleted, you will not be able to recover this coupon!";
        var swalType   = 'warning';
        var ajaxType   = 'delete';
        var url        = "{!! url('coupon' ) !!}" + "/" + id;
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }
    
    function changeState(id){
        var token      = $("meta[name='csrf-token']").attr("content");
        var text       = "Change the Status of Coupon!";
        var swalType   = 'info';
        var ajaxType   = 'get';
        var url        = "{!! url('coupon_state' ) !!}";
        var data       = {'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }
    </script>
@endpush
