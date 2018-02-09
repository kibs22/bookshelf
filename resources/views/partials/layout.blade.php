<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Bookshelf Admin</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-editable.css')}}">
    <link rel="stylesheet" href="{{asset('/bootstrap/dist/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('bower_components/Ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{asset('css/datatables.bootstrap.css')}}">
</head>
<body class="hold-transition skin-red sidebar-mini">
  <div class="wrapper">
     <!-- HEADER NAV -->
     <header class="main-header">
        <a href="index2.html" class="logo">
          <span class="logo-mini"><b>B</b>BS</span>
          <span class="logo-lg"><b>Book</b>Shelf</span>
        </a>

        <nav class="navbar  navbar-static-top">
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        
          <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="images/admin.png" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ Auth::User()->firstname }}<i style="margin-top:3px; margin-left: 8px" class="fa fa-angle-down pull-right"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="images/admin.png" class="img-circle" alt="User Image">
                            <p>
                            {{ Auth::User()->firstname }} {{ Auth::User()->lastname }}- Admin
                            <small>Member since {{ Auth::User()->created_at}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                            <a href="{{url ('/profile')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                            <a href="{{url ('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                            </div>
                        </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li> -->
                    </ul>
                </div>

        </nav>
      </header>
    <!-- SIDE BAR -->
    <aside class="main-sidebar">
      <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">Administration</li>
          <li >
            <a href="{{ url('/dashboard')}}">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              <span class="pull-right-container">
                <i class="pull-right"></i>
              </span>
            </a>
          </li>
          <li >
            <a href="{{ url('/userList')}}">
              <i class="fa fa-list"></i> <span>User List</span>
              <span class="pull-right-container">
                <i class="pull-right"></i>
              </span>
            </a>
          </li>
          <li >
            <a href="{{ url('/category')}}">
              <i class="fa fa-tags"></i> <span>Manage Category</span>
              <span class="pull-right-container">
                <i class="pull-right"></i>
              </span>
            </a>
          </li>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user"></i> <span>Manage Admin</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
               @if(Auth::user()->role_type == 'SUPERADMIN')
               <li class="">
                  <a href="{{ url('/manageAdmin')}}">
                    <i class="fa fa-user"></i> <span>Add</span>
                    <span class="pull-right-container">
                    </span>
                  </a>
                </li>
               @endif
                <li>
                  <a href="{{ url('/adminList')}}">
                  <i class="fa fa-users"></i> <span>List</span> 
                  <span class="pull-right-container"> 
                  </a>
                </li>
            </ul>
          </li> 
          
          <li class="treeview">
            <a href="#">
              <i class="fa fa-user-times"></i> <span>Manage  Reports</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
               <li class="">
                  <a href="{{ url('/reportAdmin')}}">
                    <i class="fa fa-user"></i> <span>Add Report</span>
                    <span class="pull-right-container">
                    </span>
                  </a>
                </li>
               <li class="">
                  <a href="{{ url('/viewreportAdmin')}}">
                    <i class="fa fa-user"></i> <span>Report List</span>
                    <span class="pull-right-container">
                    </span>
                  </a>
                </li>
                 <li class="">
                  <a href="{{ url('/userReports')}}">
                    <i class="fa fa-user"></i> <span>User Reports</span>
                    <span class="pull-right-container">
                    </span>
                  </a>
                </li>
            </ul>
          </li>     
        </ul>
      </section>
    </aside>

    @yield ('content')
   
  </div>
</body>

    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/Chart.js/Chart.js') }}"></script>
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('js/sweet.js')}}"></script>
    <script src="{{ asset('js/bootstrap-editable.min.js')}}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
  })

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

</script>

<script type="text/javascript">
  $(document).ready(function(){
      $('.table').DataTable();
  });
</script>
  
  @stack('js')


</html>
