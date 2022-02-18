@extends('layouts.main')
@push('style')
    <style>
        th[title='Action'] {
            min-width: 10rem;
        }

    </style>
@endpush
@php
$routeFor = \Route::currentRouteName() == 'hotels.index' ? 'undrafted' : 'drafted';
@endphp
@section('breadcrumb-button')
@if ($routeFor == 'drafted')
<button type="button" id="back_btn" onclick="window.history.back()"
    class="btn btn-secondary mr-10"> <i class="fa fa-arrow-left"></i> Back</button>
@endif
    @if (auth()->user()->hasAddPermission($routeName))
        <a class="btn btn-info pull-right mx-2" href="{{ route('hotels.create') }}"><i class="fa fa-plus"
                aria-hidden="true"></i> Create New
            Hotel</a>
    @endif
    @if ($routeFor == 'undrafted')
        <a type="button" class="btn btn-danger text-light mx-2" href="{{ route('hotels.drafted') }}"><i
                class="fa fa-briefcase" aria-hidden="true"></i> Drafted <span
                class="badge badge-light">{{ $countDraft }}</span></a>
    @endif
@endsection
@if ($routeFor == 'undrafted')
    @section('title', 'Hotel Services')
@else
    @section('title', 'Hotel Services(drafted)')
@endif
@section('main')
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Hotels</h4>
                </div>
                <div class="box-body">
                    @if (auth()->user()->hasViewPermission($routeName))
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
                    @endif
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
            var url = "{!! url('services/hotels') !!}" + "/" + id;
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
            var url = "{{ url('hotel/state') }}";
            console.log(text);
            var data = {
                '_token': token,
                'column': columnName,
                'hotel_id': sID,
                'state': state
            }
            ConfirmSwal(text, swalType, ajaxType, url, data)
        }
        function AdminApproval(columnName, sID, state) {
            var token = csrfToken();
            var text = 'Change ' + columnName + ' to ' + state;
            var swalType = 'info';
            var ajaxType = 'post';
            var url = "{{ url('hotel/state') }}";
            console.log(text);
            var data = {
                '_token': token,
                'column': columnName,
                'hotel_id': sID,
                'approval': state
            }
            ConfirmSwal(text, swalType, ajaxType, url, data)
        }
    </script>
@endpush