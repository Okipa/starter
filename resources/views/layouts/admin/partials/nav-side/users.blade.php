<li class="nav-item">
    <a class="nav-link load-on-click {{ Str::contains(request()->route()->getName(), ['users', 'user.create', 'user.edit']) ? 'active' : null }}"
       href="{{ route('users.index') }}"
       title="@lang('Users')">
        <i class="fas fa-users fa-fw"></i>
        @lang('Users')
    </a>
</li>
