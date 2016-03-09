<?php
/**
 * Created by PhpStorm.
 * User: vu
 * Date: 3/9/16
 * Time: 2:54 PM
 */
?>

        <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Sign up</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="/assets/backend/AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/assets/backend/AdminLTE-2.3.0/plugins/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/assets/backend/AdminLTE-2.3.0/plugins/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/backend/AdminLTE-2.3.0/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/assets/backend/AdminLTE-2.3.0/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Custom style -->
    <link rel="stylesheet" href="/css/login_signup.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <b>Đăng ký</b>
    </div><!-- /.login-logo -->

    @if(session()->has('notification'))
        <div class="box box-solid box-danger">
            <div class="box-header">
                <h3 class="box-title">{!! trans('general.Error') !!}</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
                {!! session('notification') !!}
            </div><!-- /.box-body -->
        </div>
    @endif

    <div class="login-box-body">
        <p class="login-box-msg">Đăng ký bằng email</p>
        <form action="/signup" method="post" id="form-sign-up">
            {!! csrf_field() !!}
            <div class="form-group has-feedback">
                <input type="text" name="lastname" class="form-control" placeholder="Họ tên đệm">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="text" name="firstname" class="form-control" placeholder="Tên">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" id="password" class="form-control" placeholder="Mật khẩu">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="repassword" class="form-control" placeholder="Nhập lại mật khẩu">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Đăng ký</button>
                </div><!-- /.col -->
            </div>
        </form>

        <div class="social-auth-links text-center">
            <p>- hoặc -</p>
            <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Đăng ký bằng Facebook</a>
            <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Đăng ký bằng Google+</a>
        </div><!-- /.social-auth-links -->

        Đã có tài khoản <a href="{!! route('login') !!}" class="text-center">Đăng nhập</a> ngay.

    </div><!-- /.login-box-body -->
</div><!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="/assets/backend/AdminLTE-2.3.0/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="/assets/backend/AdminLTE-2.3.0/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="/assets/backend/AdminLTE-2.3.0/plugins/iCheck/icheck.min.js"></script>
<!-- Jquery Validate -->
<script src="/assets/backend/AdminLTE-2.3.0/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
<!-- Custom script -->
<script src="/js/login_signup.js"></script>


</body>
</html>
