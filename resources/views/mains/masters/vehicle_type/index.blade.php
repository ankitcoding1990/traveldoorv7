@extends('layouts.main')

@section('main')


@if (auth()->user()->hasAddPermission($routeName))
  <div class="row">
      <div class="col-12">
          <div class="box">
              <div class="box-body">
                  @if(isset($vehicle))
                  @section('title','Edit Vehicle Type')
                    {!! Form::model($vehicle, ['method' => 'put','enctype' => 'multipart/form-data', 'class' => 'package_form','route' => ['vehicles_types.update', $vehicle->id]]) !!}
                    @include('mains.masters.vehicle_type._form')
                    <div class="row mb-10">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-rounded btn-primary mr-10 pull-right">Update</button>
                        </div>
                    </div>
                    @else
                    @section('title','Add New Vehicle Type')
                    {!! Form::open(['method' => 'post', 'id' => 'menu_form', 'class' => 'package_form']) !!}
                      @include('mains.masters.vehicle_type._form')
                      <div class="row mb-10">
                          <div class="col-md-12">
                              <button type="submit"  id="save_vehicle_type" class="btn btn-rounded btn-primary mr-10 pull-right">Submit</button>
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
                    <div class="table-responsive">
                        <input type="hidden" id="token" name="token_delete" value="{{csrf_token()}}">
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
    <script>

        $(document).on('submit','.package_form', function(){
            event.preventDefault()
            if(Validate()){
                ajaxFormSubmit($(this))
            }
        })

     function delUser(id){
        var token = $("meta[name='csrf-token']").attr("content");
        var text       = "Once deleted, you will not be able to recover this vehicle type!";
        var swalType   = 'warning';
        var ajaxType   = 'delete';
        var url        = "{!! url('vehicles_types' ) !!}" + "/" + id;
        var data       = {'_token': token,'id':id};
        ConfirmSwal(text,swalType,ajaxType,url,data);
    }

    function ChangeState(id, state) {
        var token = csrfToken();
        var text = 'Change status to '+state;
        var swalType = 'info';
        var ajaxType = 'get';
        var url = "{{ url('/vehicle_type/state') }}";
        var data = {state : state, _token : token, id: id}
        ConfirmSwal(text,swalType,ajaxType,url,data)
    }

    </script>
@endpush


</body>
</html>
