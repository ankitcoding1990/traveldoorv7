@extends('layouts.main')

@section('title','Service Terms Master')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Service Terms</h4>
                </div>
                <div class="box-body">
                    {!! Form::open(['class' => 'package_form','method' => 'post','route' => 'service_terms.store']) !!}
                        @include('mains.masters.service_terms._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" id="save_terms_master" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                            </div>
                        </div>
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
@if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
@endif
    <script>
        $('#service_name').change(function(){
            GetTerms()
        })

        function GetTerms(){
            var service = $('#service_name').val()
            if(service != '') {
                $.ajax({
                    type: 'get',
                    url: '{{url("/get_terms")}}',
                    data: {'service': service},
                    success: function(data){
                        if(data){
                            console.log(data);
                            CKEDITOR.instances['terms_conditions'].setData(data.terms_conditions);
                            CKEDITOR.instances['cancel_policy'].setData(data.cancel_policy);
                            CKEDITOR.instances['confirm_msg'].setData(data.confirm_msg);
                            $('#terms_id').val(data.id)
                        }
                        else{
                            CKEDITOR.instances['terms_conditions'].setData('');
                            CKEDITOR.instances['cancel_policy'].setData('');
                            CKEDITOR.instances['confirm_msg'].setData('');
                            $('#terms_id').val('')
                        }
                        $('.data-div').show()
                    }
                })
            }
        }
    </script>
@endpush
