@include('mains.includes.top-header')

<body class="hold-transition light-skin sidebar-mini theme-rosegold onlyheader">

<div class="wrapper">

@include('mains.includes.top-nav')

<div class="content-wrapper">

    <div class="container-full clearfix position-relative">

@include('mains.includes.nav')

	<div class="content">

	<!-- Content Header (Page header) -->

	<div class="content-header">

		<div class="d-flex align-items-center">

			<div class="mr-auto">

				<h3 class="page-title">User Management</h3>

				<div class="d-inline-block align-items-center">

					<nav>

						<ol class="breadcrumb">

							<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>

							<li class="breadcrumb-item" aria-current="page">Dashboard</li>

							<li class="breadcrumb-item active" aria-current="page">User Management

							</li>

						</ol>

					</nav>

				</div>

			</div>

			<!-- <div class="right-title">

				<div class="dropdown">

					<button class="btn btn-outline dropdown-toggle no-caret" type="button" data-toggle="dropdown"><i

							class="mdi mdi-dots-horizontal"></i></button>

					<div class="dropdown-menu dropdown-menu-right">

						<a class="dropdown-item" href="#"><i class="mdi mdi-share"></i>Activity</a>

						<a class="dropdown-item" href="#"><i class="mdi mdi-email"></i>Messages</a>

						<a class="dropdown-item" href="#"><i class="mdi mdi-help-circle-outline"></i>FAQ</a>

						<a class="dropdown-item" href="#"><i class="mdi mdi-settings"></i>Support</a>

						<div class="dropdown-divider"></div>

						<button type="button" class="btn btn-rounded btn-success">Submit</button>

					</div>

				</div>

			</div> -->

		</div>

	</div>





	<div class="row">

	 <div class="col-12">
	  @if($rights['add']==1 || $rights['view']==1)
			<div class="box">





				<div class="box-body">



					<div class="row">




	@if($rights['add']==1)
						<div class="col-sm-6 col-md-3">

							<div class="form-group">



								<a href="{{route('users.create')}}"><button type="button"

										class="btn btn-rounded btn-success">Create User or Partner</button>

								</a>


							</div>

						</div>
						@endif




@if($rights['view']==1)
						<div class="col-12">

							<div class="box">


								<!-- /.box-header -->

								<div class="box-body" style="padding:0">


									<div class="table-responsive">

                                        <div class="row">

                                        <table id="user_table" class="table table-bordered table-striped">

											<thead>

												<tr>

													<th>Employee Code</th>

													<th>Role</th>

													<th>First Name</th>

													<th>Last Name</th>

													<th>Username</th>

													<th>Contact Number</th>

													<th>Email</th>



													<th>Last Login</th>

													<th>Status</th>

													<th>Action</th>



												</tr>

											</thead>

											<tbody>

												@foreach($get_users as $users)

												<tr id="tr_{{$users->users_id}}">
													@if($users->users_pid!=Session::get('travel_users_id') && strpos($rights['admin_which'],'view')===false)
													continue;
													@endif

													<td>{{$users->users_empcode}}</td>

													<td>{{$users->users_assigned_role}}</td>

													<td>{{$users->users_fname}}</td>

													<td>{{$users->users_lname}}</td>

													<td>{{$users->users_username}}</td>

													<td>{{$users->users_contact}}</td>

													<td>{{$users->users_email}}</td>



													<td>{{$users->last_login}}</td>

													<td>@if($users->users_status==1)

														Active

														@else

														InActive

													@endif</td>

													<td>

													@if($rights['edit_delete']==1)
													<a href="{{route('user-details',['users_id'=>$users->users_id])}}"><i class="fa fa-eye"></i></a>
													@endif

													@if($rights['view']==1)
														<a href="{{route('edit-user',['users_id'=>$users->users_id])}}"><i class="fa fa-pencil"></i></a>
														@endif


													</td>

												</tr>

												@endforeach





											</tbody>



										</table>
                  </div>
									</div>
								</div>
								<!-- /.box-body -->
							</div>
						</div>
						@endif
					</div>
				</div>
				<!-- /.row -->

			</div>

			@else
	<h4 class="text-danger">No rights to access this page</h4>

			@endif

			<!-- /.box-body -->

		</div>



		<!-- /.box -->



	</div>



</div>

</div>

</div>

@include('mains.includes.footer')

@include('mains.includes.bottom-footer')

<script>

	$(document).ready(function()

	{
    $('#user_table').DataTable({
		"responsive": true,
		"columnDefs": [
		            { responsivePriority: 1, targets: 0 },
		            { responsivePriority: 2, targets: 4 }
		        ]
    });

		$('#date_range').daterangepicker({

			locale: {

				format: 'YYYY-MM-DD',

				cancelLabel: 'Clear'

			}

		});

	});

</script>





</body>





</html>
