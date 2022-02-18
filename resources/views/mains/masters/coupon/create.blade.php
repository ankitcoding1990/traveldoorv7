@extends('layouts.main')

@section('main')

@if(true)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                @if (isset($coupon))
                @section('title','Edit Coupon')
                  {!! Form::model($coupon, ['method' => 'put', 'class' => 'package_form','route' => ['coupon.update', $coupon->id]]) !!}
                  @include('mains.masters.coupon._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
                @else
                @section('title','Create Coupon')
                  {!! Form::open(['method' => 'post', 'id' => 'menu_form', 'class' => 'package_form','route' => ['coupon.store']]) !!}
                  @include('mains.masters.coupon._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" id="save_service" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                        </div>
                    </div>
                @endif

                {!! Form::close() !!}
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
        $(document).ready(function()
        {
            $('.loader').hide();
        })
        $('.datepicker').datepicker({
            autoclose:true,
			todayHighlight: true,
			format: 'yyyy-mm-dd',
        });

        $(document).on('input','#no_of_person, #min_value, #coupan_amount', function (event) {
                this.value = this.value.replace(/[^0-9]+/g, ''); });

        $(document).on('click','#generate_coupan',function (){
            var request = ['coupan_name'];
            $.each(request,function(key,item){
                pause =validation(item);
            })
            if(!pause){
                return false
            }
            var data = $('#coupan_name').val();
            $('.loader').show();
            $.ajax({
            url: "{{url('/generate_coupon')}}",
            enctype: 'multipart/form-data',
            data: {'data': data},
            type: "get",
            success: function (response)
            {
                $('#coupan_code').val(response);
                $('.loader').hide();
            }
            });
        })
    </script>
@endpush
