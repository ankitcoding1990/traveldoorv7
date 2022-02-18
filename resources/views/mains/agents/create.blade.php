@extends('layouts.main')

@section('title','Agent Management')
@isset($agent)
@section('subtitle','Update Agent Profile')
@else
@section('subtitle','Create Agent Profile')
@endisset
@php
if(isset($agent)){
  $breadcrumbs = [
    [
      'title' =>  'Agents',
      'link'  =>  '',
    ],
    [
      'title' =>  'Edit Agent',
      'link'  =>  '',
    ],
  ];
  
}else {
  $breadcrumbs = [
    [
      'title' =>  'Agents',
      'link'  =>  '',
    ],
    [
      'title' =>  'Create Agent',
      'link'  =>  '',
    ],
  ];
  }
@endphp

@push('css')

@endpush

@section('main')

  <div class="row">
      <div class="col-12">
          <div class="box">
              <div class="box-header with-border">
                  <h4 class="box-title">@yield('subtitle')</h4>
              </div>
              <div class="box-body">
                @php
                $admin = true;

            @endphp
                @isset($agent)
                {!! Form::open(['files' => true, 'route' => ['agents.update', $agent->id], 'method' => 'put', 'onsubmit' => 'ajaxFormSubmit($(this))' ]) !!}
                <x-agents.form :isAdmin="$admin" :agent="$agent" />
              {!! Form::close() !!}
                  @else
                  {!! Form::open(['id' => 'register_agent_form', 'files' => true, 'route' => 'agents.store', 'method' => 'post', ]) !!}
                  <x-agents.form :isAdmin="$admin"  />
            {!! Form::close() !!}
                @endisset
              
              </div>
          </div>
      </div>
  </div>

@endsection

@push('scripts')

@endpush
