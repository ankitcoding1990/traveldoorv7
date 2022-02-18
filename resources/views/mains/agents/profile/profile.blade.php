@extends('mains.agents.show')

@section('profile')
<x-agents.profile-index :agent="$agent" />
@endsection
