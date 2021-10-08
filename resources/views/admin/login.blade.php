<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title Page-->
    <title>Login</title>



    <!-- Fontfaces CSS-->
    <link href=" {{ asset('admin_assets/css/font-face.css') }} " rel="stylesheet" media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-4.7/css/font-awesome.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin_assets/vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('admin_assets/vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet"
        media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.css') }}" rel="stylesheet" media="all">


    <!-- Main CSS-->
    <link href="{{ asset('admin_assets/css/theme.css') }}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a class="btn">
                                {{ config('constants.site_name') }}
                            </a>
                        </div>
                        <div class="login-form">
                            <form action=" {{ route('admin.auth') }} " method="post">
                                {{ @csrf_field() }}
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class="au-input au-input--full" type="email" required name="email"
                                        placeholder="Email">
                                    <span style="color:red">@error('email')
                                            {{ $message }}
                                        @enderror</span>
                                </div>

                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="au-input au-input--full" type="password" required name="password"
                                        placeholder="Password">
                                    <span style="color:red">@error('password')
                                            {{ $message }}
                                        @enderror</span>
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" name="submit"
                                    type="submit">sign in</button>


                                @if (session()->has('msg'))
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        {{ session('msg') }}
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('admin_assets/vendor/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/popper.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/bootstrap-4.1/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->


    <script src="{{ asset('admin_assets/vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('admin_assets/vendor/animsition/animsition.min.js') }}"></script>


    <!-- Main JS-->
    <script src="{{ asset('admin_assets/js/main.js') }}"></script>

</body>

</html>
<!-- end document-->
