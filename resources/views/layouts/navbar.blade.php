<nav class="mb-1 navbar navbar-expand-lg navbar-dark default-color">
    <a class="navbar-brand" href="{{ isset($info->name) ? route('home', $info->name) : '' }}">Logo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div id="navbarNavDropdown" class="navbar-collapse collapse justify-content-end">
        <ul class="navbar-nav mr-auto">
            @if (empty($tenantInfo))
                <li class="nav-item @if (isset($slug) && $slug == 'tenant') active @endif">
                    <a class="nav-link" href="{{ route('viewCreateTenant') }}">
                        Tenant
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            @endif
            @can('browse_user')
                <li class="nav-item @if (isset($slug) && $slug == 'user') active @endif">
                    <a class="nav-link" href="{{ route('home') }}">
                        Users
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            @endcan
            @can('browse_role')
                <li class="nav-item @if (isset($slug) && $slug == 'role') active @endif">
                    <a class="nav-link" href="{{ route('showListRoles') }}">
                        Roles
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
            @endcan
            <li class="nav-item @if (isset($slug) && $slug == 'schedule') active @endif">
                <a class="nav-link" href="{{ route('viewSchedule') }}">
                    Schedule
                    <span class="sr-only">(current)</span>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav nav-pills nav-fill">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>&nbsp;&nbsp;
                @if(isset($info))
                    {{ $info->name }}
                @else
                    {{ Auth::user()->name }}
                @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <li>
                        <a class="dropdown-item" href="javascript:void(0);"><b>{{ Auth::user()->email }}</b></a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}" style="color: red">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>