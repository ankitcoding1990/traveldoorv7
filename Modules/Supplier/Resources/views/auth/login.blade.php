 @extends('supplier::layouts.auth')

@section('title', 'Supplier Login')

@section('content')
    <div class="px-30 pb-30">
        <h3 class="text-center login-h3 font-weight-bold">Supplier Login</h3>
        <form id="authLoginForm" class="pt-10" action="{{ route('supplier.login') }}" onsubmit="authLogin($(this))" method="post">

            {{ csrf_field() }}



            <p id="login-form-message"></p>
            {{-- username --}}
            <div class="form-group">
              <label for=""><i class="ti-user"></i> Username or Email  </label>
                <input id="login_username" type="text" class="form-control pl-15 bg-transparent  plc-white"
                    placeholder="Username" name="name">
                <div class="invalid-feedback"></div>
            </div>
            {{-- /username --}}
            {{-- password --}}
            <div class="form-group">
              <label for=""> <i class="ti-lock"></i> Password</label>
              <input id="login_password" type="password" class="form-control pl-15 bg-transparent  plc-white"
                  placeholder="Password" name="password">
              <div class="invalid-feedback">

              </div>


            </div>
            {{-- /password --}}

            <div class="row">

                <div class="col-12 text-center">
                    <button type="submit" id="sign_in" class="btn  mt-10 log-signin">SIGN IN</button>
                </div>
                <div class="col-12 text-left my-4">
                    <label>Don't have a account yet? <a href="{{ route('supplier.register') }}" class="text-info">Sign Up</a></label>
                </div>
                {{-- <div class="col-6 text-right my-4">
                    <label><a href="{{ route('supplier.forget-password') }}" class="text-info">Forget Password</a></label>
                </div> --}}

            </div>

        </form>

    </div>
@endsection
