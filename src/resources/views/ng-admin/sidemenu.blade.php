<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        @if(Auth::user()->image)
          <img src="{{ Auth::user()->image }}" class="img-circle" alt="{{ Auth::user()->name }}">
        @else
          <img src="/node_modules/admin-lte/dist/img/avatar.png" class="img-circle" alt="{{ Auth::user()->name }}">
        @endif
      </div>
      <div class="pull-left info">
        <p> {{ Auth::user()->name }}</p>
        <a href="#"><i class="fa fa-circle text-success"></i> En ligne</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">

      <li class="header">MENU </li>

      <li class="treeview">
        <a href="#/dashboard">
          <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
        </a>
      </li>

      @ability('sa','employee.create')
      <li class="treeview">
        <a href><i class="fa fa-user"></i> <span>Utilisateurs</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
        <li><a href="#/role">Roles</a></li>
        @role('sa')
        <li><a href="#/permission">Permissions</a></li>
        @endrole
        <li><a href="#/users">Utilisateurs</a></li>
        </ul>
      </li>
      @endability

      @role('sa')
      <li class="treeview">
        <a href><i class="fa fa-download"></i> <span> Param&eacute;tres </span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#/setting">Parametres avancés</a></li>
        </ul>
      </li>
      @endrole

    </ul>

  </section>
  <!-- /.sidebar -->
</aside>
