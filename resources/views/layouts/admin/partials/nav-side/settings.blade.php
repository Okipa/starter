<li class="nav-item">
    <a{{ classTag('nav-link', 'load-on-click', in_array(request()->route()->getName(), ['settings']) ? 'active' : null) }}
       href="{{ route('settings') }}"
       title="@lang('nav.admin.settings')">
        <i class="fas fa-cogs fa-fw"></i>
        @lang('nav.admin.settings')
    </a>
</li>
