<li class="nav-item">
    <a class="nav-link {{ Str::contains(request()->route()->getName(), ['pages.index', 'page.create', 'page.edit']) ? 'active' : null }}"
       href="{{ route('pages.index') }}"
       title="@lang('Pages')">
        <i class="fas fa-file-alt fa-fw"></i>
        @lang('Pages')
    </a>
</li>
