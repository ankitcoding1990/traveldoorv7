@extends('layouts.main')

@section('title','Special Offers')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add Special Offer</h4>
                </div>
                <div class="box-body">
                    @if(isset($specialOffer))
                        {{-- @php
                            $inc = $specialOffer->inclusions;
                            $exc = $specialOffer->exclusions;
                        @endphp --}}
                        {!! Form::model($specialOffer, ['class' => 'package_form','id' =>  'menu_form', 'method' => 'put','route' => ['special_offers.update',$specialOffer->id]]) !!}
                        @include('mains.masters.special_offers._form')
                        <div class="row mb-10">
                            <div class="col-md-12 mt-4">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {{-- @php
                            $inc = null;
                            $exc = null;
                        @endphp --}}
                        {!! Form::open(['method' => 'POST', 'id' => 'menu_form', 'class' => 'package_form']) !!}
                        @include('mains.masters.special_offers._form')
                        <div class="row mb-10">
                            <div class="col-md-12 mt-4">
                                <button type="button" id="save_offer" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                            </div>
                        </div>
                    @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    @isset($dataTable)
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Special Offers Available</h4>
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
    var inc_count = $('count-i').val();
    var exc_count = $('count-e').val();
    var pause = true;
    $('#itinerary_id').select2();

    $(document).on('click','.inclusionsIncrement',function(){
        var html = `<div class='input-group my-3 inclusionsDiv'>{!! Form::text('inclusions[]', null, ['class' => 'form-control','placeholder' => 'Including Schema', 'id' => 'inclusions', 'autofocus']) !!}  <button type='button' class='btn btn-default' onclick='
            ($(this))'>&times;</button></div>`
        $('.inclusions').append(html)
        inc_count++;
    });

    $(document).on('click','.exclusionsIncrement',function(){
        var html = `<div class='input-group my-3 exclusionsDiv'>{!! Form::text('exclusions[]', null, ['class' => 'form-control','placeholder' => 'Excluding Schema', 'id' => 'exclusions', 'autofocus']) !!}  <button type='button' class='btn btn-default' onclick='remdiv($(this))'>&times;</button> </div>`
        $('.exclusions').append(html)
        exc_count++;
    });
    function remdiv(selector,store = false){
        $(selector).parent('div').remove();
        if(store){
            $('#del').val(store);
        }
    }

    $(document).on('input','#price, #price_child, #price_infant', function (event) {
            this.value = this.value.replace(/[^0-9]+/g, ''); });

            $(document).on('click','#save_offer',function(){
            var request = ['title','price','itinerary_id','description','package','image'];
            $.each(request,function(key,item){
                pause =validation(item);
            })
            if(!pause){
                console.log('ajax stopped');
                return false
            }
            $("#save_offer").prop("disabled", true);
            var data = new FormData($('#menu_form')[0]);
            $.ajax({
                url: "{{route('special_offers.store')}}",
                data: data,
                type: "POST",
                processData: false,
                contentType: false,
                success: function(response) {
                    swal(response[1],response[0],response[1])
                    $('.dataTable ').DataTable().ajax.reload();
                    $("#menu_form")[0].reset();
                    $("#save_offer").prop("disabled", false);
                },
                error: function(error) {
                    $("#save_offer").prop("disabled", false);
                    if (typeof error.responseJSON.errors == 'object') {
                    formInputErrors(form, error.responseJSON.errors);
                    }else if(typeof error.responseJSON.message == 'string'){
                            formInputErrorsClear(form);
                        swal({
                            title: "Warning",
                            text: error.responseJSON.message,
                            type: 'warning'
                            });
                    }
                }
            });
        })

        function delColumn(id){
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this special offer!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    var token = $("meta[name='csrf-token']").attr("content");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type:'delete',
                        url: "{!! url('special_offers' ) !!}" + "/" + id,
                        data: {id:id},
                        processData: false,
                        contentType: false,
                        success: function(response)
                        {
                            swal(response[1],response[0],response[1]);
                            $('.dataTable ').DataTable().ajax.reload();
                        }
                    });
                }
            })
        }
</script>

@endpush
