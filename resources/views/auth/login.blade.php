<!DOCTYPE html>
<html>
<head>

    <title>KATHINK</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login/login.css') }}">

</head>
<body>
<video autoplay muted loop id="myVideo" style="position: absolute;top: 0px;box-shadow: 0px 0px 122px black;height:100%;width:100%;">
<source src="kathinklogin.mp4" type="video/mp4">
  	Your browser does not support the video tag.
</video>
<div class="container">

    <h1 style="top: 300px;">LOGIN</h1>                

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf


                            <label for="username" class="login" style="top: 450px;">Username</label>


                                <input id="username" type="text" name="username" class="log" value="{{ old('username') }}" required autocomplete="username" autofocus style="top: 500px;">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror



                            <label for="password" class="login" style="top: 570px;">Password</label>


                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" style="position: absolute;left:  400px;border:5px solid black;font-size: 30pt;height: 50px;width: 590px;top: 630px;">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror



                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember">

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="button">
                                    Login
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>

    


                </div>
            </div>

</body>
</html>

