<li class="nav-item">
    <a class="nav-link load-on-click {{ Str::contains(request()->route()->getName(), ['simplePages', 'simplePage.create', 'simplePage.edit']) ? 'active' : null }}"
       href="{{ route('simplePages.index') }}"
       title="@lang('Simple pages')">
        <i class="fas fa-file-alt fa-fw"></i>
        @lang('Simple pages')
    </a>
</li>
