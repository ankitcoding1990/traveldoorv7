@extends('agent::layouts.profile')

@section('title', 'Agent Profile')
<style>
    .file {
        border: 2px dashed #aaa;
        text-align: center;
        padding: 4px;
    }

    .file>label {
        color: #aaa;
        padding: 4.6rem;
    }

    .file>img {
        max-width: calc(30rem + 5vw);
        display: block;
        max-height: calc(20rem + 3vh);
        margin: auto;
    }

</style>
@section('profile')
    {!! Form::model($agent, ['method' => 'put', 'route' => ['agent.profile.update', $agent->id], 'onsubmit' => 'ajaxFormSubmit($(this))']) !!}
    {{-- import form --}}
    <x-agents.form :showAllComponents=false :agent="$agent" />
    {{-- /Import form --}}
      {!! Form::close() !!}
@endsection
