<li class="nav-item">
    <a class="nav-link load-on-click {{ in_array(request()->route()->getName(), ['users', 'user.create', 'user.edit']) ? 'active' : null }}"
       href="{{ route('users') }}"
       title="@lang('nav.admin.users')">
        <i class="fas fa-users fa-fw"></i>
        @lang('nav.admin.users')
    </a>
</li>
