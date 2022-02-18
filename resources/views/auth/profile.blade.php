@extends('layouts.profile')

@section('title', ' Profile - '. $user->name)

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
			<div class="row">
                <div class="col-md-3">
					<div class="box">
						<div class="box-body">
                            <img src="{{ $user->image ?? asset('assets/images/user-placeholder.png') }}" alt="user">
                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                        </div>
					</div>
					<div class="box">
						<div class="box-body">
							<h4>About Me</h4>
							<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
					</div>
				</div>
				<div class="col-md-9">
					 {{-- basic detail --}}
						<div class="box">
							<div class="box-body">
								<table class="table table-hover table-border-borderless">
									<tr>
										<th>First Name</th>
										<td>{{ $user->users_fname ?? '' }}</td>
									</tr>
									<tr>
										<th>Last Name</th>
										<td>{{ $user->users_lname ?? '' }}</td>
									</tr>
									<tr>
										<th width="170">Name </th>
										<td>{{ $user->name }}</td>
									</tr>
									<tr>
										<th width="170">Unique Username </th>
										<td><mark>{{ $user->username }}</mark></td>
									</tr>
									<tr>
										<th>Email</th>
										<td>{{ $user->email }}</td>
									</tr>
									<tr>
										<th>Contact No.</th>
										<td>{{ $user->users_contact }}</td>
									</tr>
									<tr>
										<th>Email verified Date</th>
										<td>{{ $user->email_verified_at ?? 'Pending' }}</td>
									</tr>
									<tr>
										<th>Parent User</th>
										<td>
											@if ($user->user != null)
												{{ $user->user->name }}
											@else
												...........
											@endif
										</td>
									</tr>
									<tr>
										<th>Role</th>
										<td>{{ $user->users_role ?? '' }}</td>
									</tr>
									<tr>
										<th>Status</th>
										<td>{{ $user->users_status ?? '' }}</td>
									</tr>
									<tr>
										<th>Last Login</th>
										<td>{{ $user->last_login ?? '' }}</td>
									</tr>
									<tr>
										<th>Created Date</th>
										<td>{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() ?? '' }}</td>
									</tr>
									<tr>
										<th>Updated Date</th>
										<td>{{ \Carbon\Carbon::parse($user->updated_at)->toDayDateTimeString() ?? '' }}</td>
									</tr>




								</table>
							</div>
						</div>
						{{-- /basic detail --}}
				</div>

			</div>

		</div>
	</div>
@endsection
