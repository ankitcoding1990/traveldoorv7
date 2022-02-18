@extends('layouts.main')

@section('main')

@if(true)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                @if (isset($service))
                @section('title','Edit Service')
                  {!! Form::model($service, ['method' => 'put','files' => true, 'class' => 'package_form','route' => ['service_master.update', $service->id]]) !!}
                  @include('mains.masters.service_master._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
                @else
                @section('title','Create Service')
                  {!! Form::open(['method' => 'post', 'id' => 'menu_form','files' => true, 'class' => 'package_form','route' => ['service_master.store']]) !!}
                  @include('mains.masters.service_master._form')
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
        $(document).ready(function(){
            fetchCities();
            $('#country_id').select2();
        })
        $('#country_id').change(function(){
            fetchCities();
        })

        function fetchCities(){
            var country = $('#country_id').val();
            var selected = parseInt($('#city_selected').val());
            if(country != ""){
                    $.ajax({
                    url:'{{url("/get-cities")}}',
                    dataType: 'JSON',
                    method: 'get',
                    data: {'country': country},
                    success: function (response){
                        if(response)
                        {
                            html ='<option disabled selected hidden>--Select City--</option>'
                            $.each(response,function(key, value){
                                if(selected == key){
                                    html += `<option selected value = ${key} >${value}</option>`
                                }
                                else{
                                    html += `<option value = ${key} >${value}</option>`
                                }
                            })
                        }
                        else{
                            html = '<option disabled selected hidden>--No Avalaible City For This Country--</option>'
                        }
                        $('#city_id').html(html)
                        $('#city_id').select2();
                    }
                })
            }
        }

        function remdiv(selector,store = false){
            $(selector).parent('div').remove();
            if(store){
                $('#del').val(store);
            }
        }

        $(document).on('input','#price_per_pax, #price_per_service', function (event) {
                this.value = this.value.replace(/[^0-9]+/g, ''); });
    </script>
@endpush
