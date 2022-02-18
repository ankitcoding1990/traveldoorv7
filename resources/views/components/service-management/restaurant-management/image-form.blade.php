@extends($layout)

@section('title','Edit Restaurant')

@if($isSupplier)
    @section('breadcrumb-button')
        <a class="btn btn-primary" href="{{route('restaurant.index')}}"> <i class="fa fa-list"></i>  View</a>
    @endsection
    @section('content')
@else
    @section('breadcrumb-button')
        <a class="btn btn-primary" href="{{route('restaurants.index')}}"> <i class="fa fa-list"></i>  View</a>
    @endsection
    @section('main')
@endif

<div class="box mt-2">
    <div class="row">
        <div class="col-12">
            <div class="box-heading p-2">
                <x-service-management.restaurant-management.steps />
            </div>
            <div class="box-body">
                {{-- basic form inputs --}}
               {!! Form::open(['route' =>  ['restaurant.images.store', $restaurant->id],'onsubmit'=>'ajaxFormSubmit($(this))', 'method' => 'get', 'autocomplete' => 'off', 'files' => true]) !!}
               
               
                    <x-service-management.image-upload :service="'restaurant'" :referenceId="$restaurant->id ?? null" />
                    <button class="btn btn-warning my-3 pull-right" type="submit">
                        <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i> Save
                    </button>
            
               
               {!! Form::close() !!}
            </div>
        </div>
    </div> 
</div> 
@endsection