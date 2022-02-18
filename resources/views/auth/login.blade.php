@extends('layouts.auth')


@section('title', 'Admin Login')

@section('auth')
	<div class="px-30 pb-30">

		<form id="authLoginForm" action="{{ route('login') }}" onsubmit="authLogin($(this))" method="post">

			{{csrf_field()}}
			<h3 class="text-center login-h3">Admin Login</h3>

			<p id="login-form-message"></p>
			{{-- username --}}
			<div class="form-group">

				<div class="input-group mb-25">

					<div class="input-group-prepend">

						<span class="input-group-text text-white bg-transparent"><i class="ti-user"></i></span>

					</div>

					<input id="login_username" type="text" class="form-control pl-15 bg-transparent  plc-white" placeholder="Username" name="username">
					<div class="invalid-feedback">

					</div>
				</div>

			</div>
			{{-- /username --}}
			{{-- password --}}
			<div class="form-group">

				<div class="input-group mb-25">

					<div class="input-group-prepend">

						<span class="input-group-text text-white bg-transparent"><i class="ti-lock"></i></span>

					</div>

					<input id="login_password" type="password" class="form-control pl-15 bg-transparent  plc-white" placeholder="Password"  name="password">
					<div class="invalid-feedback">

					</div>

				</div>

			</div>
			{{-- /password --}}

				<div class="row">

					<div class="col-12 text-center">
						<button type="submit" id="sign_in" class="btn btn-warning btn-outline mt-10 log-signin">SIGN IN</button>
					</div>
					<div class="col-12">
						<div class="or-choice">OR</div>
					</div>
					<div class="col-md-12 mt-20">
						<div class="row">
							<div class="col-sm-6 mb-15">
								<div class="button-wrapper">
										<p>Login</p>
										<a href="{{route('agent.login')}}" class="btn-login m-b-10">
											Agent
										</a>
										<a href="{{route('supplier.login')}}" class="btn-create m-b-10">
											Supplier
										</a>
								</div>
							</div>
							<div class="col-sm-6 mb-15">
								<div class="button-wrapper">
									<p>Create</p>
									<a href="{{route('agent.register')}}" class="btn-login m-b-10">
										Agent
									</a>

									<a href="{{route('supplier.register')}}" class="btn-create m-b-10">
										Supplier
									</a>
								</div>
							</div>
						</div>

					</div>
				</div>
		</form>
	</div>
@endsection
