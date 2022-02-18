@extends('layouts.main')

@section('title','Target Commission')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Target</h4>
                </div>
                <div class="box-body">
                    @if (isset($target))
                        {!! Form::model($target, ['method' => 'put', 'class' => 'package_form','route' => ['target_commission.update', $target->id]]) !!}
                        @include('mains.masters.target_commission._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form' ,'class' => 'package_form']) !!}
                        @include('mains.masters.target_commission._form')
                            <div class="row mb-10">
                                <div class="col-md-12">
                                    <button type="button"  id="save_target_commission" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                    <h4 class="box-title">View Expense Category</h4>
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
        $(document).on('input','#st_amount, #st_commission_per', function (event) {
            this.value = this.value.replace(/[^0-9]+/g, ''); });

        $(document).on('click','#save_target_commission',function(){
            var st_amount = $('#st_amount').val();
            var st_commission_per = $('#st_commission_per').val();
            var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
            if(st_amount.trim() == "")
            {
                $("#st_amount").css("border","1px solid #cf3c63");
                $("#st_amount").focus();
                if(!$('.error-msg').length > 0)
                    $("#st_amount").parent('div').append(error)
                return false;
            }
            else
            {
                $("#st_amount").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            if(st_commission_per.trim() == "")
            {
                $("#st_commission_per").css("border","1px solid #cf3c63");
                $("#st_commission_per").focus();
                if(!$('.error-msg').length > 0)
                    $("#st_commission_per").parent('div').append(error)
                return false;
            }
            else
            {
                $("#st_commission_per").css("border","1px solid #9e9e9e");
                if($('.error-msg').length > 0)
                    $('.error-msg').remove();
            }
            // $("#save_target_commission").prop("disabled", true);
            var data = new FormData($('#menu_form')[0]);
            $.ajax({
                url: "{{route('target_commission.store')}}",
                data: data,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    swal(response[1],response[0],response[1])
                    $('.dataTable ').DataTable().ajax.reload();
                    $("#menu_form")[0].reset();
                    $("#save_target_commission").prop("disabled", false);
                }
            });
        })

    </script>
@endpush
