@extends('layouts.main')

@section('title','Guide Expenses Cost')
@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Guide Expenses Cost</h4>
                </div>
                <div class="box-body">
                    @if (isset($guide_expenses))
                        @php
                            $selected = $guide_expenses->guide_expense;
                        @endphp
                        {!! Form::model($guide_expenses, ['method' => 'put', 'class' => 'package_form','route' => ['guide_expenses.update', $guide_expenses->id]]) !!}
                        @include('mains.masters.guide_expenses._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                    @php
                        $selected = null;
                    @endphp
                        {!! Form::open(['class'=>'package_form','method'=>'post', 'id' => 'menu_form']) !!}
                        @include('mains.masters.guide_expenses._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" id="save_guide_expense" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                        <h4 class="box-title">View Guide Expenses Cost</h4>
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

{{-- @if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
@endif --}}
@isset($dataTable)
{!! $dataTable->scripts() !!}
@endisset
    <script>

        $(document).on('submit','.package_form',function(){
            event.preventDefault()
            if(Validate()){
                ajaxFormSubmit($(this))
            }
        })

        function delColumn(id){
            var token = $("meta[name='csrf-token']").attr("content");
            var text       = "Once deleted, you will not be able to recover this Guide Expenses!";
            var swalType   = 'warning';
            var ajaxType   = 'delete';
            var url        = "{!! url('guide_expenses' ) !!}" + "/" + id;
            var data       = {'_token': token,'id':id};
            ConfirmSwal(text,swalType,ajaxType,url,data);
        }


        // $(document).on('keydown','#guide_expense_cost',function (e) {
        //     var code = e.keyCode;
        //     if(code == 13) {
        //         $("#save_guide_expense").trigger("click");
        //     }
        // });

        // $(document).on("click","#save_guide_expense",function()
        // {
        //     event.preventDefault();
        //     var error = "<p class = 'text-danger error-msg'>Please Fiil Out This Field</p>";
        //     var guide_expense_name = $("#guide_expense_name").val();
        //     var guide_expense_cost = $("#guide_expense_cost").val();

        //     if(guide_expense_name.trim() == "")
        //     {
        //         $("#guide_expense_name").css("border","1px solid #cf3c63");
        //         $("#guide_expense_name").focus();
        //         if(!$('.error-msg').length > 0)
        //             $("#guide_expense_name").parent('div').append(error)
        //         return false;
        //     }
        //     else
        //     {
        //         $("#guide_expense_name").css("border","1px solid #9e9e9e");
        //         if($('.error-msg').length > 0)
        //             $('.error-msg').remove();
        //     }
        //     if(guide_expense_cost.trim() == "")
        //     {
        //         $("#guide_expense_cost").css("border","1px solid #cf3c63");
        //         $("#guide_expense_cost").focus();
        //         if(!$('.error-msg').length > 0)
        //             $("#guide_expense_cost").parent('div').append(error)
        //         return false;
        //     }
        //     else
        //     {
        //         $("#guide_expense_cost").css("border","1px solid #9e9e9e");
        //         if($('.error-msg').length > 0)
        //             $('.error-msg').remove();
        //     }
        //     $("#save_guide_expense").prop("disabled",true);
        //     var formdata=new FormData($("#menu_form")[0]);
        //     $.ajax({
        //         url:"{{route('guide_expenses.store')}}",
        //         data: formdata,
        //         type:"POST",
        //         processData: false,
        //         contentType: false,
        //         success:function(response)
        //         {
        //             $("#save_guide_expense").prop("disabled",false);
        //             swal(response[1],response[0],response[1])
        //             $('.dataTable ').DataTable().ajax.reload();
        //             $("#menu_form")[0].reset();
        //             $("#save_guide_expense").prop("disabled",false);
        //         }
        //     });
        // });
    </script>
@endpush
