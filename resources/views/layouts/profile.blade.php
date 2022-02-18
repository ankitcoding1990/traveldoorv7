@extends('layouts.main')

@section('title', 'Users')

@section('subtitle', 'Profile')

@php
	$breadcrumbs = [
		[
			'title'	=>	'Users',
			'link'	=>	'',
		],
		[
			'title'	=>	'Profile',
			'link'	=>	''
		]
	];
@endphp


@section('main')
	<div class="row">
		<div class="col-md-12">
				<div class="box">

				</div>
		</div>
	</div>
@endsection
