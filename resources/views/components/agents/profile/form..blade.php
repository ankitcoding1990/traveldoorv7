@isset($agent)
@endphp
{!! Form::model($agent, ['method' => 'put', 'route' => ['agent.profile.update', $data], 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
@endisset

{{-- import form --}}
@include('components.profile._form-inputs')
{{-- /Import form --}}

<button type="submit" class="btn btn-primary">Submit </button>


{!! Form::close() !!}
