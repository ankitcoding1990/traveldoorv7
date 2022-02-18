 @extends('agent::layouts.auth')

@section('title', 'Agent Login')

@section('content')
    <div class="px-30 pb-30">

        <form id="authLoginForm" action="{{ route('agent.login') }}" onsubmit="authLogin($(this))" method="post">

            {{ csrf_field() }}
            <h3 class="text-center login-h3">Agent Login</h3>

            <p id="login-form-message"></p>
            {{-- username --}}
            <div class="form-group">

                <div class="input-group mb-25">

                    <div class="input-group-prepend">

                        <span class="input-group-text text-white bg-transparent"><i class="ti-user"></i></span>

                    </div>

                    <input id="login_username" type="text" class="form-control pl-15 bg-transparent  plc-white"
                        placeholder="Username" name="name">
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

                    <input id="login_password" type="password" class="form-control pl-15 bg-transparent  plc-white"
                        placeholder="Password" name="password">
                    <div class="invalid-feedback">

                    </div>

                </div>

            </div>
            {{-- /password --}}

            <div class="row">

                <div class="col-12 text-center">
                    <button type="submit" id="sign_in" class="btn btn-warning btn-outline mt-10 log-signin">SIGN IN</button>
                </div>
                <div class="col-6 text-left my-4">
                    <label>Don't have a account yet? <a href="{{ route('agent.register') }}" class="text-info">Sign Up</a></label>
                </div>
                <div class="col-6 text-right my-4">
                    <label><a href="{{ route('agent.forget-password') }}" class="text-info">Forget Password</a></label>
                </div>

            </div>

        </form>

    </div>
@endsection
