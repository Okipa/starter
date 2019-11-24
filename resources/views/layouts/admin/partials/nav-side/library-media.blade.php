<li class="nav-item">
    <a{{ classTag('nav-link', 'load-on-click', in_array($route, ['libraryMedia.index', 'libraryMedia.create', 'libraryMedia.edit']) ? 'active' : null) }}
       href="{{ route('libraryMedia.index') }}"
       title="@lang('nav.admin.libraryMedia')">
        <i class="fas fa-photo-video fa-fw"></i>
        @lang('nav.admin.libraryMedia')
    </a>
</li>
