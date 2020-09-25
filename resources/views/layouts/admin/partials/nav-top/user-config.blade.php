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
            @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
                <a href="{{ route('profile.information') }}"
                   class="dropdown-item {{ request()->route()->getName() === 'profile.information' ? 'active' : null }}"
                   title="@lang('Profile information')">
                    <i class="fas fa-user-circle fa-fw"></i>
                    @lang('Profile information')
                </a>
                <div class="dropdown-divider"></div>
            @endif
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
