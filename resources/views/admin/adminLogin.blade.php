<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bookshelf Admin Login</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b>Bookshelf</b>Admin</a>
  </div>
  <div class="login-box-body">
    <p class="login-box-msg">LOGIN</p>
    
      <form action="/adminLogin" method="post">
          {{ csrf_field() }}
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          @if($errors->has('email'))
             <div style="color:#E74C3C"><li>{{$errors->first('email')}}</li></div>
          @endif
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          @if($errors->has('password'))
             <div style="color:#E74C3C"><li>{{$errors->first('password')}}</li></div>
          @endif
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button type="submit" class="btn btn-danger btn-block btn-flat btn-blocked">Sign In</button>
          </div>
        </div>
      </form>
  </div>
  <div class="row">
    <br><div class="class col-md-12">
      @if (session('loginError'))
        <div class="alert alert-danger alert-dismissible">
          <li>   {{ session('loginError') }}</li>
        </div>
      @endif
    </div>
  </div>
</div>
  
</body>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })
</script>
  
  @stack('js')

</html>
