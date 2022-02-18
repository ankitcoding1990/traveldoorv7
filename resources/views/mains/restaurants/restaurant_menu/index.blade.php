@extends('layouts.main')
@section('main')

@if(auth()->user()->hasAddPermission($routeName))
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add New Restaurant Menu Category</h4>
            </div>
            <div class="box-body">
                <form class="package_form" action="javascript:void()" method="POST" id="menu_form">
                    {!! Form::open(['method' => 'POST', 'id' => 'menu_form']) !!}
                    @include('mains.restaurants.restaurant_menu._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit"  id="save_restaurant_menu_category" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

 <div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">View Restaurant Menu Category</h4>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    @isset($dataTable)
                    {!! $dataTable->table() !!}
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
@else
<h4 class="text-danger">No rights to access this page</h4>
@endif
@endsection
@push('styles')
<style>
    .iti-flag {
    width: 20px;
    height: 15px;
    box-shadow: 0px 0px 1px 0px #888;
    background-image: url("{{asset('assets/images/flags.png')}}") !important;
    background-repeat: no-repeat;
    background-color: #DBDBDB;
    background-position: 20px 0
    }
    div#cke_1_contents {
    height: 250px !important;
    }
    </style>
@endpush
@push('scripts')
    @if (session()->has('status'))
        <script>
        swal('{{session('status')['title']}}','{{session('status')['message']}}','{{session('status')['type']}}');
        </script>
    @endif
    @isset($dataTable)
    {!! $dataTable->scripts() !!}
    @endisset

    <script>
    $(document).on("submit","#menu_form",function(){
        var restaurant_menu_category_name=$("#restaurant_menu_category_name").val();
        if(restaurant_menu_category_name.trim()=="")
        {
            $("#restaurant_menu_category_name").css("border","1px solid #cf3c63");
        }
        else
        {
            $("#restaurant_menu_category_name").css("border","1px solid #9e9e9e");
            $.ajax({
                url:'{{route('restaurant-categories.store')}}',
                data: $('#menu_form').serialize(),
                type:"POST",
                success:function(response){
                    if(response.status == true){
                        swal({title:"Success", text:response.message, type: "success"})
                        $('.dataTable ').DataTable().ajax.reload();
                        $('#menu_form').trigger("reset")
                    }else if(response.status == false){
                        swal({title:"Fail", text:response.message ,type: "fail"})
                    }else{
                        swal({title:"Warning", text:response.message ,type: "warning"})
                    }
                }
            });
        }
    });

    </script>
@endpush
