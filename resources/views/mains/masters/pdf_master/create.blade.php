@extends('layouts.main')

@section('main')

@if(true)
<div class="row">
    <div class="col-12">
        <div class="box">
            <div class="box-body">
                @if (isset($pdf))
                @section('title','Edit PDF')
                  {!! Form::model($pdf, ['method' => 'put','files' => true, 'class' => 'package_form','route' => ['pdf_master.update', $pdf->id]]) !!}
                  @include('mains.masters.pdf_master._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit"  class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
                @else
                @section('title','Create PDF')
                  {!! Form::open(['method' => 'post', 'id' => 'menu_form','files' => true, 'class' => 'package_form','route' => ['pdf_master.store']]) !!}
                  @include('mains.masters.pdf_master._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" id="save_pdf" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                            <a class="btn btn-primary" href="{{url()->previous()}}"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
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
        function remdiv(event,file_name,selector){
            $(event).parent().remove()
            $('#'+selector).val(file_name);
        }
    </script>
@endpush
