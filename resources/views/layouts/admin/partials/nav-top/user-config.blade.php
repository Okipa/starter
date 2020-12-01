<li class="nav-item{{ currentRouteIs('profile.edit') ? ' active' : null }}">
    <div class="dropdown">
        <a href=""
           class="dropdown-toggle nav-link"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false">
            {{ auth()->user()->getFirstMedia('profile_pictures')->img('top-nav', ['class' => 'rounded-circle mr-1']) }}
            <span class="d-none d-sm-inline-block">
                {{ auth()->user()->full_name }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
                <a href="{{ route('profile.edit') }}"
                   class="dropdown-item{{ currentRouteIs('profile.edit') ? ' active' : null }}"
                   title="@lang('Profile')">
                    <i class="fas fa-user-circle fa-fw"></i>
                    @lang('Profile')
                </a>
                <div class="dropdown-divider"></div>
            @endif
            <form id="logout-form" class="p-0" method="POST" action="{{ route('logout') }}" novalidate>
                @csrf()
                <button type="submit"
                        class="dropdown-item btn btn-link"
                        title="@lang('Logout')"
                        data-confirm="@lang('Are you sure you want to logout?')">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    @lang('Logout')
                </button>
            </form>
        </div>
    </div>
</li>
