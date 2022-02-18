@extends('layouts.main')

@section('title','Agent Management')

@section('subtitle','List of Agents')

@php
  $breadcrumbs = [
    [
      'title' =>  'Agents',
      'link'  =>  '',
    ],
    [
      'title' =>  'List Of Agent',
      'link'  =>  '',
    ],
  ];
@endphp

@section('breadcrumb-button')
@if(auth()->user()->hasViewPermission($routeName))
  <a href="{{ route('agents.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New</a>
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
							<h4 class="box-title">Agent's</h4>
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
        var text       = "Change the State of Agent!";
        var swalType   = 'info';
        var ajaxType   = 'post';
        var url        = "{{url('/update/agent-active')}}";
        var data       = {'_token': token,'id':id};
		loader();
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
