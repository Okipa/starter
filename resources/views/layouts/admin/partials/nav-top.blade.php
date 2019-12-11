<ul id="topnav" class="navbar-nav nav bg-dark flex-column flex-grow-1 align-content-end align-items-end">
    {{-- language --}}
    <li class="nav-item">
        @include('components.common.language.selector', [
            'dropdownLabelClasses' => ['nav-link'],
            'dropdownMenuClasses' => ['dropdown-menu-right'],
        ])
    </li>
    {{-- top menu --}}
    <li class="nav-item {{ request()->route()->getName() === 'user.profile' ? 'active' : null }}">
        <div class="dropdown">
            <a href=""
               class="dropdown-toggle nav-link"
               data-toggle="dropdown"
               aria-haspopup="true"
               aria-expanded="false">
                <i class="fas fa-user-check fa-fw text-success"></i>
                <span class="d-none d-sm-inline-block">
                    {{ auth()->user()->name }}
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('user.profile.edit') }}"
                   class="dropdown-item load-on-click {{ request()->route()->getName() === 'user.profile' ? 'active' : null }}"
                   title="@lang('My profile')">
                    <i class="fas fa-user-circle fa-fw"></i>
                    @lang('My profile')
                </a>
                <div class="dropdown-divider"></div>
                <form id="logout-form" class="p-0" action="{{ route('logout') }}" method="POST">
                    @csrf()
                    <button type="submit"
                            class="dropdown-item btn btn-link"
                            title="@lang('Logout')"
                            data-confirm="@lang('Are you sure you want to logout ?')">
                        <i class="fas fa-sign-out-alt fa-fw"></i>
                        @lang('Logout')
                    </button>
                </form>
            </div>
        </div>
    </li>
</ul>
