@extends('agent::layouts.master')
@section('title', 'Service Markups')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3>Add up your markups here</h3>
        </div>
        <div class="box-body">
            {!! Form::open(['id' => 'makrup_form', 'url' => 'agent/markup/update', 'method' => 'post']) !!}
                {!! Form::hidden('agent_id', auth()->guard('agent')->id()) !!}
                <div class="row">
                    @foreach ($services as $key => $service)
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label>{{ $service->name }}</label>
                                {!! Form::hidden('service['.$key.'][id]',$service->id) !!}
                                {!! Form::text('service['.$key.'][price]', $service->pivot->agent_markup ?? null, ['class' => 'form-control validate', 'id' => $service->id, 'placeholder' => 'Enter ' . lcfirst($service->name) . ' Markup']) !!}
                            </div>
                        </div>
                    @endforeach
                    <div class="col-sm-12">
                        <button class="btn btn-success btn-rounded pull-right"><i class="fa fa-check" aria-hidden="true"></i> Save</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).on('submit','#makrup_form', function(){
            event.preventDefault()
            if(Validate()){
                ajaxFormSubmit($(this))
            }
        })
    </script>
@endpush
