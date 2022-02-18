@extends('agent::layouts.master')

@section('content')
  <div class="box">
      <div class="box-body">
        <div class="col-12">
            <div class="box">
                <div class="box-body">
                   <div class="row">
                        @if((count($services))>0)
                            @foreach($services as $service)
                                <div class="col-md-4 col-sm-6 col-xs-12 mb-30" >
                                    <div class="hovereffect">
                                        <img class="img-responsive" src="{{ asset('assets/images/services/'.$service->slug.'.jpg') }}" alt="{{$service->slug}}">
                                        <div class="overlay">
                                            <h2>{{$service->name}}</h2>
                                            <p>
                                                <a href="{{route('agent.'.$service->slug.'.search')}}">CLICK HERE</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
