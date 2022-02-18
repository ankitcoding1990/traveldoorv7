<!DOCTYPE html>
<html lang="en">
  <head>
			<x-theme.head />
      <title>Agent Registration Form</title>
			@stack('style')

	</head>
<style>
    .file{
        border: 2px dashed #aaa;
        text-align: center;
        padding: 4px;
    }
    .file > label{
        color: #aaa;
        padding: 4.6rem;
    }
    .file > img{
        max-width: calc(30rem + 5vw);
        display: block;
        max-height: calc(20rem + 3vh);
        margin: auto;
    }
</style>
<body>
    <div class="container my-4">
        <h2 class="title bg-white m-auto text-center pt-2">Agent Registration Form</h2>
        <div class="jumbotron bg-white border-rounded">
            {!! Form::open(['id' => 'register_agent_form', 'route'=>'agent.register', 'method' => 'POST','files' => 'true' ]) !!}
            <x-agents.form :isAdmin=false/>
            {!! Form::close() !!}
        </div>
    </div>
    <x-theme.scripts />
    @stack('scripts')

</body>
