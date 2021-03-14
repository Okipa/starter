<li class="nav-item{{ currentRouteIs('profile.edit') ? ' active' : null }}">
    <div class="dropdown">
        <a href=""
           class="dropdown-toggle nav-link"
           data-bs-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false">
            {{ auth()->user()->getFirstMedia('profile_pictures')->img('top-nav', ['class' => 'rounded-circle me-1']) }}
            <span class="d-none d-xl-inline">
                {{ auth()->user()->full_name }}
            </span>
        </a>
        <div class="dropdown-menu dropdown-menu-end">
            @if(Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updateProfileInformation()))
                <a href="{{ route('profile.edit') }}"
                   class="dropdown-item{{ currentRouteIs('profile.edit') ? ' active' : null }}"
                   title="{{ __('Profile') }}">
                    <i class="fas fa-user-circle fa-fw"></i>
                    {{ __('Profile') }}
                </a>
                <div class="dropdown-divider"></div>
            @endif
            <form id="logout-form" class="p-0" method="POST" action="{{ route('logout') }}" novalidate>
                @csrf()
                <button type="submit"
                        class="dropdown-item btn btn-link"
                        title="{{ __('Logout') }}"
                        data-confirm="{{ __('Are you sure you want to logout?') }}">
                    <i class="fas fa-sign-out-alt fa-fw"></i>
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </div>
</li>
