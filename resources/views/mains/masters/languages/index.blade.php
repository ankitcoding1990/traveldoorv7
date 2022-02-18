@extends('layouts.main')
@section('main')
 @if (auth()->user()->hasAddPermission($routeName))
    <div class="row">
        <div class="col-12">
            <div class="box">
                <div class="box-header with-border">
                    <h4 class="box-title">Languages</h4>
                </div>
                <div class="box-body">
                    @if (isset($language))
                    @section('title','Edit Language')
                    {!! Form::model($language, ['method' => 'put', 'class' => 'package_form','route' => ['languages.update', $language->id]]) !!}
                    @include('mains.masters.languages._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit"  class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                            </div>
                        </div>
                    @else
                    @section('title','Create Language')
                    {!! Form::open(['method' => 'post', 'id' => 'menu_form', 'class' => 'package_form']) !!}
                    @include('mains.masters.languages._form')
                        <div class="row mb-10">
                            <div class="col-md-12">
                                <button type="submit" id="save_languages" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
                            </div>
                        </div>
                    @endif

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
 @endif


 @if (auth()->user()->hasViewPermission($routeName))
    @isset($dataTable)
        <div class="row">
            <div class="col-12">
                <div class="box">
                    <div class="box-body">
                        <div class="box service-tab">
                            <ul class="nav nav-tabs">
                                <li>
                                    <a class="nav-link" href="{{route('languages.index',['active'])}}">Active</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{route('languages.index',['inactive'])}}">Inactive</a>
                                </li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                                {!! $dataTable->table() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
 @endif

@endsection



@push('scripts')

  @isset($dataTable)
    {!! $dataTable->scripts() !!}
  @endisset

  @if (session()->has('status'))
  <script> swal('{{session()->get("status")[1]}}','{{session()->get("status")[0]}}','{{session()->get("status")[1]}}') </script>
  @endif
  <script type="text/javascript">

    $(document).on('submit','.package_form',function () {
        event.preventDefault()
        if(Validate()){
            ajaxFormSubmit($(this))
        }
    });

  </script>
@endpush
