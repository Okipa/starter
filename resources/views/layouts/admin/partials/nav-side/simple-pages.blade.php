<li class="nav-item">
    <a class="nav-link load-on-click {{ in_array(request()->route()->getName(), ['simplePages', 'simplePage.create', 'simplePage.edit']) ? 'active' : null }}"
       href="{{ route('simplePages') }}"
       title="@lang('nav.admin.simplePages')">
        <i class="fas fa-file-alt fa-fw"></i>
        @lang('nav.admin.simplePages')
    </a>
</li>
