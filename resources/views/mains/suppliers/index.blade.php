@extends('layouts.main')

@section('title', 'Suppliers Management')
@section('subtitle', 'List of Suppliers')

@php
  $breadcrumbs = [
    [
      'title' =>  'List of Suppliers',
      'link'  =>  null
    ],
  ];
@endphp
@push('style')
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
	  .action-btn {
		  cursor: pointer;
	  }
  </style>
@endpush
@section('breadcrumb-button')
    @if(auth()->user()->hasViewPermission($routeName))
        <a href="{{route('suppliers.create')}}"><button type="button" class="btn btn-rounded btn-success">Create Supplier</button></a>
    @endif
@endsection
@section('main')
@if(auth()->user()->hasViewPermission($routeName))
@isset($dataTable)
<div class="row">
	<div class="col-12">
		<div class="box">
			<div class="box-header with-border">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-8">
							<h4 class="box-title">Supplier's</h4>
						</div>
					</div>
				</div>
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
@endif


{{-- modal --}}

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="result-popup" aria-hidden="true"
    style="display: none;" id="change_password_modal">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="result-popup">CHANGE PASSWORD</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body passwordChangeBody">

            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection


@push('scripts')
	@isset($dataTable)
		{!! $dataTable->scripts() !!}
	@endisset
  <script>

	function changeState(id){
        var token = $("meta[name='csrf-token']").attr("content");
        var text       = "Change the State of Supplier!";
        var swalType   = 'info';
        var ajaxType   = 'post';
        var url        = "{{url('change_supplier_state')}}";
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }

	function changePassword(url) {
        event.preventDefault();
        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {
				$('.passwordChangeBody').html(response);
                $('#change_password_modal').modal('show');
            }
        })
    }
	$(document).on('click','.close',function () {
        $('#change_password_modal').modal('hide');
    })
  </script>
@endpush
