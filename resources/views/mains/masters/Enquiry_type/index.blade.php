@extends('layouts.main')

@section('title','Enquiry Type')

@section('main')

@if(auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Add New Enquiry Type</h4>
                </div>
                <div class="box-body">
                    @if (isset($enquiry_type))
                        {!! Form::model($enquiry_type, ['method' => 'put', 'class' => 'package_form','route' => ['enquiry_type.update', $enquiry_type->id]]) !!}
                        @include('mains.masters.enquiry_type._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                        {!! Form::open(['method' => 'post', 'id' => 'menu_form', 'class' => 'package_form']) !!}.
                        @include('mains.masters.enquiry_type._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" id="save_enquiry_type" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                            </div>
                        </div>
                    @endif
                    </form>
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
                    <h4 class="box-title">View Enquiry Type</h4>
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
<script>

    $(document).on('submit','.package_form',function(){
        event.preventDefault()
        if(Validate()){
            ajaxFormSubmit($(this))
        }
    })
</script>
@endpush
