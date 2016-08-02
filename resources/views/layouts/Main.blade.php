<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>University Resource Scheduler </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
  <!--DataTables-->
  <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap.css') }}">
  <!--JqueryConfirm-->
  <link rel="stylesheet" href="{{ asset('css/jquery-confirm.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('css/select2/select2.min.css') }}">
  <!-- Date Range Picker -->
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('css/datepicker3.css') }}">
  <!-- Time Picker CSS -->
  <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}">
  <!-- iCheck CSS -->
  <link rel="stylesheet" href="{{ asset('css/iCheck/iCheck-all.css') }}">

  <!-- REQUIRED JS SCRIPTS -->

  <!--Date Range Picker  -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <!-- jQuery 2.2.0 -->
  <script src="https://code.jquery.com/jquery-2.2.3.min.js"   integrity="sha256-a23g1Nt4dtEYOj7bR+vTu7+T8VP13humZFBJNIYoEJo="   crossorigin="anonymous"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('js/app.min.js') }}"></script> 
  <!--DataTables Jquery Plugin-->
  <script src="{{ asset('js/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('js/datatables/dataTables.bootstrap.min.js') }}"></script>
  <!--JqueryConfirm-->
  <script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <!-- Include Date Range Picker -->
  <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
  <!-- Date Picker -->
  <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
  <!-- Include Time Picker -->
  <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>
  <!-- iCheck -->
  <script src="{{ asset('js/icheck.min.js') }}"></script>
  <!-- Notify.js -->
  <script src="{{ asset('js/notify.js') }}"></script>
  <!-- jsPDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>


  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->

  <link rel="stylesheet" href="{{ asset('css/skins/_all-skins.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
  <!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
  <!--[endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>U</b>RS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>University</b>RS</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <!-- Menu toggle button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><!-- No of messages --></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 0 messages</li>
              <li>
                <!-- inner menu: contains the messages -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <!-- User Image -->
<!--                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">-->
                      </div>
                      <!-- Message title and timestamp -->
                      <h4>
                       <!-- Message Heading -->
                        <small><i class="fa fa-clock-o"></i> <!-- Message time --></small>
                      </h4>
                      <!-- The message -->
                      <p><!-- short message --></p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
                <!-- /.menu -->
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- /.messages-menu -->

           <!-- Notifications -->

        <?php
        use App\Notifications;
        use Carbon\Carbon;

        /**
         * Get all the notifications available
         */
        $adminStatus                 = Auth::user()->admin;
        $Notifications               = Notifications::where('updated_at', '>=',Carbon::now()->subDays(7))->where('forAdmin','=',$adminStatus)->get();
        ?>
        <!-- Notifications Menu -->
            <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell-o"></i>
                    @if($Notifications->count() > 0)
                        <span class="label label-warning">
                            {{ $Notifications->count() }}
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu">
                    <li class="header">You have {{ $Notifications->count() }} notifications</li>
                    @foreach($Notifications as $notification)
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                <li><!-- start notification -->
                                    <a href="{{ $notification->url }}">
                                        <i class="fa fa-flag text-red"></i> <!-- New message count -->
                                        {{ $notification->notification }}
                                    </a>
                                </li>
                                <!-- end notification -->
                            </ul>
                        </li>
                    @endforeach
                    <li class="footer"><a href="#">View all</a></li>
                </ul>
            </li>

          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              <img src="/dist/img/{{ Auth::user()->picture }}" class="user-image" alt="User Image">
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
              <li class="user-header">
                <img src="/dist/img/{{ Auth::user()->picture }}" class="img-circle" alt="User Image">

                <p>
                 {{ Auth::user()->name }} - 
                    @if(Auth::user()->admin == 0)
                        Lecturer
                    @else
                        Administrator
                    @endif
                  <small>Member since 
                    {{ date("F",mktime(0,0,0,date_parse_from_format("Y-m-d",substr(Auth::user()->created_at,2,8))["month"],10)) }} {{ substr(Auth::user()->created_at, 0, 4)  }}
                  </small>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dist/img/{{ Auth::user()->picture }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->

        </div>
      </div>

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"></li>
        <!-- Optionally, you can add icons to the links -->
        <li><a href="/"><i class="fa fa-home"></i> <span>Home</span></a></li>
          @if(Auth::user()->admin == 0)

        <li class="treeview">
          <a href="/userRequest/requestForm">
            <i class="fa fa-dashboard"></i> <span>My Requests</span> <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu" style="display: none;">
            <li><a href="/userRequest/requestForm"></i> Place Request</a></li>
            <li class=""><a href="/userRequest/Show"></i>Current Requests</a></li>
          </ul>
        </li>
        <li><a href="/myTables"><i class="fa fa-calendar"></i> <span>My Timetables</span></a></li>
          @endif
        @if(Auth::user()->admin == 1)
        <li class="treeview">
          <a href="#"><i class="fa fa-tachometer"></i> <span>Management</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="/UserManagement">User Management</a></li>
            <li><a href="/adminRequest">Requests Management</a></li>
            <li><a href="#">Data Management</a></li>
            <li><a href="/resource/show">Resource Management</a></li>
            <li><a href="/subject">Subject Management</a></li>
            <li><a href="/batch">Batch Management</a></li>
            <li><a href="/timetable">Timetable Management</a></li>
          </ul>
        </li>
        <li><a href="AdminOptions"><i class="fa fa-users"></i> <span>Administrator Settings</span></a></li>
        @endif
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) 
    Each and every view must contain a section-header content which is the title of the page
    -->
    @yield('section-header')

    <!-- Main content -->
    <section class="content">

      <!-- Your Page Content Here -->
      
      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      SriLankan Institute of Information Technology
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2016 <a href="#">SLIIT</a>.</strong> All rights reserved.

  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
              
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript::;">
             
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
           <!-- Menu item -->
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
