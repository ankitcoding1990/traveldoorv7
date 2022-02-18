@extends('layouts.main')
@section('title', 'Agent Management')
@section('subtitle', 'Edit Agent')
@php
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
@endphp
@section('main')
@if($rights['edit_delete']==1)
     <div class="row">
         <div class="col-12">
             <div class="box">
                 <div class="box-header with-border">
                     <h4 class="box-title">Edit Agent</h4>
                 </div>
                 <div class="box-body">
                  {!! Form::model($agent,['id' => 'agentForm', 'files' => true, 'route' => ['agents.update', $agent->agent_id], 'method' => 'put']) !!}
                      <x-agents.form :agent="$agent" />
                   {!! Form::close() !!}
                 </div>
             </div>
         </div>
     </div>
     @else
       <h4 class="text-danger">No rights to access this page</h4>
     @endif
@endsection
