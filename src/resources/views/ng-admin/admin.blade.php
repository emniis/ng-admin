<!DOCTYPE html>
<html ng-app="{{ config('ng-admin.app.ng_module') }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title ng-bind="page.title + '| {{ config('ng-admin.app.name') }}' ">  Administration </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="/node_modules/admin-lte/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
{{--   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- Theme style -->
  <link rel="stylesheet" href="/node_modules/admin-lte/dist/css/AdminLTE.min.css">

  <link rel="icon" href="/icon.png" type="image/png" sizes="16x16">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="/node_modules/admin-lte/dist/css/skins/skin-red.min.css">
  <link rel="stylesheet" href="/node_modules/ng-table/dist/ng-table.min.css">
  <link rel="stylesheet" href="/node_modules/toastr/build/toastr.min.css">
  <link rel="stylesheet" href="/node_modules/ui-select/dist/select.min.css">
  <link href="/node_modules/angular-moment-picker/dist/angular-moment-picker.min.css" rel="stylesheet">
  <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
  <style type="text/css">
 .emnis-required{
  color: red;
 }
 .required:after {
   content: ' * ';
   color: red;
 }
 .ng-invalid.ng-dirty {
      border-color: #dd4b39;
      box-shadow: none;
 }
  }
  .validation-invalid{
    color: #dd4b39;
  }


.angucomplete-holder {
    position: relative;
}

.angucomplete-dropdown {
    border-color: #ececec;
    border-width: 1px;
    border-style: solid;
    border-radius: 2px;
    width: 100%;
    padding: 6px;
    cursor: pointer;
    z-index: 9999;
    position: absolute;
    /*top: 32px;
    left: 0px;
    */
    margin-top: -6px;
    background-color: #ffffff;
}

.angucomplete-searching {
    color: #acacac;
    font-size: 14px;
}

.angucomplete-description {
    font-size: 14px;
}

.angucomplete-row {
    padding: 5px;
    color: #000000;
    margin-bottom: 4px;
    clear: both;
}

.angucomplete-selected-row {
    background-color:#00A65A;
    color: #ffffff;
}

.angucomplete-image-holder {
    padding-top: 2px;
    float: left;
    margin-right: 10px;
    margin-left: 5px;
}

.angucomplete-image {
    height: 34px;
    width: 34px;
    border-radius: 50%;
    border-color: #ececec;
    border-style: solid;
    border-width: 1px;
}

.angucomplete-image-default {
    /* Add your own default image here
     background-image: url('/assets/default.png');
    */
    background-position: center;
    background-size: contain;
    height: 34px;
    width: 34px;
}

</style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-red sidebar-mini" ng-controller="AppController">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
       <span class="logo-mini">{{--<img src="/logo.png" class="img-responsive" width="50"> --}}<b>{{ config('app.name') }}</b></span>
      <!-- logo for regular state and mobile devices -->
     <span class="logo-lg">  {{-- <img src="/logo.png" class="img-responsive" width="50" style="display: inline;">  --}}<b> {{ config('app.name') }}</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="/" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="{{ url('/') }}" target="_blank" title="Visiter le site"><i class="fa fa-home"></i></a>
          </li>
          {{-- <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="/themes/admin-lte/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li> --}}
           {{-- <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Rechercher...">
            </div>
          </form> --}}
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href class="dropdown-toggle" data-toggle="dropdown">
              @if(Auth::user()->image)
                <img src="{{ Auth::user()->image }}" class="user-image" alt="{{ Auth::user()->name }}">
              @else
                <img src="/node_modules/admin-lte/dist/img/avatar.png" class="user-image" alt="{{ Auth::user()->name }}">
              @endif
              <span class="hidden-xs"> {{ Auth::user()->first_name.' '.Auth::user()->last_name }} </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(Auth::user()->image)
                  <img src="{{ Auth::user()->image }}" class="img-circle" alt="{{ Auth::user()->name }}">
                @else
                  <img src="/node_modules/admin-lte/dist/img/avatar.png" class="img-circle" alt="{{ Auth::user()->name }}">
                @endif
                <p>
                 {{ Auth::user()->name }}
                  <small> {{ Auth::user()->email }}</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#/profile" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();"
                        class="btn btn-default btn-flat">D&eacute;connexion</a>
                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                   </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  <div id="loading-bar-container"></div>
  </header>
  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  @include('ng-admin.sidemenu')
  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" ng-view>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>{{ config('ng-admin.app.name') }}</b> {{ config('ng-admin.app.version') }}
    </div>
    <strong>Copyright &copy; 2017 <a href="{{ config('ng-admin.app.website') }}">{{ config('ng-admin.developper.name') }}</a>.</strong> All rights
    reserved.
  </footer>

</div>
<!-- ./wrapper -->

<!-- jQuery  -->
<script src="/node_modules/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.6  -->
<script src="/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="/node_modules/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="/node_modules/morris.js/morris.min.js"></script>
{{-- <!-- Sparkline -->
<script src="/node_modules/admin-lte/plugins/sparkline/jquery.sparkline.min.js"></script> --}}
<!-- jvectormap -->
<script src="/node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/node_modules/admin-lte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

{{-- <!-- FastClick -->
<script src="/node_modules/admin-lte/plugins/fastclick/fastclick.js"></script> --}}
<!-- AdminLTE App -->
<script src="/node_modules/admin-lte/dist/js/adminlte.min.js"></script>
<script src="/node_modules/admin-lte/dist/js/demo.js"></script>

<!-- Angular dependencies scripts for app -->
    <script src="/node_modules/toastr/build/toastr.min.js" type="text/javascript"></script>
    <script src="/node_modules/angular/angular.min.js" type="text/javascript"></script>
    <script src="/node_modules/angular-i18n/angular-locale_fr-ci.js"></script>
    <script src="/node_modules/angular-route/angular-route.min.js" type="text/javascript"></script>
    <script src="/node_modules/angular-resource/angular-resource.min.js" type="text/javascript"></script>
    <script src="/node_modules/angular-sanitize/angular-sanitize.min.js" type="text/javascript"></script>
    <script src="/node_modules/oclazyload/dist/ocLazyLoad.min.js" type="text/javascript"></script>
    <script src="/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js" type="text/javascript"></script>
    <script src="/node_modules/ng-file-upload/dist/ng-file-upload-all.min.js" type="text/javascript"></script>
    <script src="/node_modules/ng-infinite-scroll/build/ng-infinite-scroll.min.js" type="text/javascript"></script>
    <script src="/node_modules/ng-table/dist/ng-table.min.js" type="text/javascript"></script>
    <script src="/node_modules/chart.js/dist/Chart.min.js"></script>
    <script src="/node_modules/angular-chart.js/dist/angular-chart.min.js"></script>
    <script src="/node_modules/angucomplete-alt/dist/angucomplete-alt.min.js"></script>
    <script src="/node_modules/angular-validation/dist/angular-validation.min.js" type="text/javascript"></script>
    <script src="/node_modules/angular-validation/dist/angular-validation-rule.min.js" type="text/javascript"></script>
    <script src="/node_modules/ui-select/dist/select.min.js" type="text/javascript"></script>
    <script src="/node_modules/moment/min/moment-with-locales.min.js"></script>
    <script src="/node_modules/angular-moment-picker/dist/angular-moment-picker.min.js"></script>
    <script src="/node_modules/angular-ckeditor/bower_components/ckeditor/ckeditor.js"></script>
    <script src="/node_modules/angular-ckeditor/angular-ckeditor.js"></script>
    <script src="/node_modules/angular-file-upload/dist/angular-file-upload.min.js"></script>
    <!-- Application scripts -->
    <script src="/ng-admin/boot.js" type="text/javascript"></script>
    <script src="/ng-admin/services.js" type="text/javascript"></script>
    <script src="/ng-admin/directives.js" type="text/javascript"></script>
    <script>
      $(document).ready(function () {
        $('.sidebar-menu').tree()
      })
    </script>
</body>
</html>
