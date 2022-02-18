@extends('supplier::layouts.master')
@php
$routeFor = Route::currentRouteName() == 'sightseeing.index' ? 'undrafted' : 'drafted';
@endphp
@section('breadcrumb-button')
    @if ($routeFor == 'drafted')
        <button type="button" id="back_btn" onclick="window.history.back()"
            class="btn btn-secondary mr-10"> <i class="fa fa-arrow-left"></i> Back</button>
    @endif
    <a class="btn btn-info pull-right mx-2" href="{{ route('sightseeing.create') }}"><i class="fa fa-plus"
            aria-hidden="true"></i> Create New
        Sightseeing</a>

    @if ($routeFor == 'undrafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('sightseeing.drafted') }}"><i
                class="fa fa-briefcase" aria-hidden="true"></i> Drafted <span
                class="badge badge-light">{{ $countDraft }}</span></a>
    @endif
@endsection
@if ($routeFor == 'undrafted')
    @section('title', 'Sightseeings Services')
@else
    @section('title', 'Sightseeings Services(drafted)')
@endif
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                    @isset($dataTable)
                        <div class="row">
                            <div class="col-12">
                                <div class="box">
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            {!! $dataTable->table() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset
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
        function delColumn(id) {
            var token = $("meta[name='csrf-token']").attr("content");
            var text = "Once deleted, you will not be able to recover this Sightseeing service!";
            var swalType = 'warning';
            var ajaxType = 'delete';
            var url = "{!! url('supplier/sightseeing') !!}" + "/" + id;
            var data = {
                '_token': token,
                'id': id
            };
            ConfirmSwal(text, swalType, ajaxType, url, data);
        }

        function ChangeColumnState(columnName, sID, state) {
            var token = csrfToken();
            var text = 'Change ' + columnName + ' to ' + state;
            var swalType = 'info';
            var ajaxType = 'post';
            var url = "{{ url('sightseeing/state') }}";
            console.log(text);
            var data = {
                '_token': token,
                'column': columnName,
                'sightseeing_id': sID,
                'state': state
            }
            ConfirmSwal(text, swalType, ajaxType, url, data)
        }
    </script>
@endpush
