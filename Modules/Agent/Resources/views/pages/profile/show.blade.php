@extends('agent::layouts.profile')

@section('title', 'Agent Profile')


@php
$isAgent = true;
@endphp
@section('profile')

    <x-agents.profile-index :agent="$agent" :isAgent="$isAgent"/>
    <div class="row mb-10">
        <div class="col-md-12">
            <div class="box-header with-border"
                style="padding: 10px;border-bottom:none;border-radius:0;border-top:1px solid #c3c3c3">
                <button type="button" id="discard_agent" class="btn btn-sm btn-secondary">BACK</button>
            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
