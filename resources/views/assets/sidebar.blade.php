<div class="col-xl-2 col-lg-3 col-md-4 sidebar fixed-top">
    <div class="current">
        <div class="mergen">
            <p class="murugo p-2"><span class="font-weight-bold">MURUGO</span>Cloud</p>
            <p class="dash p-2 font-weight-bold">ADMIN DASHBOARD</p>
        </div>
    </div>
    <div id="menu" class="navbar-nav flex-column mt-4 current1">
        <li class="nav-item mt-3 {{ Request::path() == 'dashboard/Analytics' ? 'selected' : '' }}">
            <a href="{{ route('dashboard.analytics') }}" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="analyse" id="analysis" ><i class="fas fa-chart-line text-dark fa-lg mr-3"></i>Analytics</a>
        </li>
        <li class="nav-item {{ Request::path() == 'dashboard/Users' ? 'selected' : '' }}">
            <a href="{{ route('dashboard.users') }}" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="use" id="user"><i class="fas fa-users text-dark fa-lg mr-3"></i>Users</a>
        </li>
        <li class="nav-item {{ Request::path() == 'dashboard/Roles' ? 'selected' : '' }}">
            <a href="{{ route('dashboard.roles') }}" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="rol" id="role"><i class="fas fa-envelope text-dark fa-lg mr-3"></i>Roles</a>
        </li>
        <li class="nav-item {{ Request::path() == 'dashboard/Permissions' ? 'selected' : '' }}">
            <a href="{{ route('dashboard.permissions') }}" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="permiss" id="permission"><i class="fas fa-shopping-cart text-dark fa-lg mr-3"></i>Permissions</a>
        </li>
        <li class="nav-item">
            <a href="{{ route('dashboard.reports') }}" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="repo" id="report"><i class="fas fa-chart-bar text-dark fa-lg mr-3"></i>Reports</a>
        </li>
        <li class="nav-item">
            <a href="#" class="tablinks nav-link text-dark p-2 mb-2 sidebar-linkadmin" value="admini" id="admin"><i class="fas fa-user text-dark fa-lg mr-3"></i>Admins</a>
        </li>
        <li class="nav-item">
            <a href="#" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="serve" id="server"><i class="fas fa-wrench text-dark fa-lg mr-3"></i>Servers</a>
        </li>
        <li class="nav-item {{ Request::path() == 'dashboard/TOS' ? 'selected' : '' }}">
            <a href="{{ route('dashboard.tos') }}" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="tost" id="toses"><i class="fas fa-file-alt text-dark fa-lg mr-3"></i>Tos</a>
        </li>
        <li class="nav-item">
            <a href="#" class="tablinks nav-link text-dark p-2 mb-2 sidebar-link" value="set" id="setting"><i class="fas fa-wrench text-dark fa-lg mr-3"></i>Settings</a>
        </li>
    </div>
</div>
