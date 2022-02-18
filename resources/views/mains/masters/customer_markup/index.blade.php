@extends('layouts.main')

@section('title','Customer Markup Cost')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Customer Markup Cost</h4>
                </div>
                <div class="box-body">
                    @if (isset($customerMarkup))
                        {!! Form::model($customerMarkup, ['method' => 'put', 'class' => 'package_form','route' => ['customer_markup.update', $customerMarkup->id]]) !!}
                        @include('mains.masters.customer_markup._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form' ,'class' => 'package_form']) !!}
                        @include('mains.masters.customer_markup._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="button"  id="save_customer_markup" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                                </div>
                            </div>
                    @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endif

@if(auth()->user()->hasViewPermission($routeName))
    @isset($dataTable)
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">View Customer Markup Cost</h4>
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
@endif
    <script>
        $(document).on('click','#save_customer_markup',function(){
            var customer_markup = $('#customer_markup').val();
            var customer_markup_cost = $('#customer_markup_cost').val();
            var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
            if(customer_markup.trim() == "")
            {
                $("#customer_markup").css("border","1px solid #cf3c63");
                $("#customer_markup").focus();
                if(!$('.error-msg').length > 0)
                    $("#customer_markup").parent('div').append(error)
                return false;
            }
            else
            {
                $("#customer_markup").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            if(customer_markup_cost.trim() == "")
            {
                $("#customer_markup_cost").css("border","1px solid #cf3c63");
                $("#customer_markup_cost").focus();
                if(!$('.error-msg').length > 0)
                    $("#customer_markup_cost").parent('div').append(error)
                return false;
            }
            else
            {
                $("#customer_markup_cost").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            $("#save_customer_markup").prop("disabled", true);
            var data = new FormData($('#menu_form')[0]);
            $.ajax({
                url: "{{route('customer_markup.store')}}",
                data: data,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    swal(response[1],response[0],response[1])
                    $('.dataTable ').DataTable().ajax.reload();
                    $("#menu_form")[0].reset();
                    $("#save_customer_markup").prop("disabled", false);
                }
            });
        })
    </script>
@endpush
