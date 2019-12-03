<li class="nav-item">
    <a{{ classTag('nav-link', 'load-on-click', in_array(request()->route()->getName(), ['dashboard']) ? 'active' : null) }}
       href="{{ route('dashboard') }}"
       title="@lang('nav.admin.dashboard')">
        <i class="fas fa-tachometer-alt fa-fw"></i>
        @lang('nav.admin.dashboard')
    </a>
</li>
