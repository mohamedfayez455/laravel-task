<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>LogIn</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('template_files/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('template_files/dist/css/adminlte.min.css')}}">
    <!-- my style -->
    <link rel="stylesheet" href="{{asset('template_files/dist/css/myStyle.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('template_files/dist/img/icons/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('template_files/dist/img/icons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('template_files/dist/img/icons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('template_files/dist/img/icons/site.webmanifest')}}">
    <link rel="mask-icon" href="{{asset('template_files/dist/img/icons/safari-pinned-tab.svg')}}" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <link rel="stylesheet" href="{{ asset('template_files/plugins/noty/noty.css') }}">
    <script src="{{ asset('template_files/plugins/noty/noty.min.js') }}"></script>
</head>

<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b> Log </b> In </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>

            @if (session('error'))
                <script>
                    new Noty({
                        type: 'error',
                        layout: 'topRight',
                        text: "{{ session('error') }}",
                        timeout: 2000,
                        killer: true
                    }).show();
                </script>
            @endif

            <form action="{{route('login')}}" method="post">
                @csrf
                @method('POST')
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">{{$message}}</div>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" name="remember" value="1" {{old('remember') == 1 ? 'checked' : ''}} id="remember">
                            <label for="remember">
                                Remember Me
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center mb-3">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-danger">
                    <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                </a>
            </div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('template_files/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('template_files/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script>
    $("#showPassword").click(() => {
        $("#showPassword").toggleClass("fas fa-eye-slash");
        $('#txtPassword').attr('type', function(index, attr) {
            return attr == 'password' ? 'text' : 'password';
        });
    })
</script>
</body>

</html>
