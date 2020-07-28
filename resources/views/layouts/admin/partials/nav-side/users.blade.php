<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('users.index')
        || currentRouteIs('user.create')
        || currentRouteIs('user.edit') ? ' active' : null }}"
       href="{{ route('users.index') }}"
       title="@lang('Users')">
        <i class="fas fa-users fa-fw"></i>
        @lang('Users')
    </a>
</li>
