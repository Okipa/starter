<li class="nav-item">
    <a class="nav-link load-on-click {{ in_array(request()->route()->getName(), ['dashboard']) ? 'active' : null }}"
       href="{{ route('dashboard.index') }}"
       title="@lang('nav.admin.dashboard')">
        <i class="fas fa-tachometer-alt fa-fw"></i>
        @lang('nav.admin.dashboard')
    </a>
</li>
