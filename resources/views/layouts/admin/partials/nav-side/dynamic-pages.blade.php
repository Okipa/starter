<li class="nav-item">
    <a{{ classTag('nav-link', 'load-on-click', in_array($route, ['dynamicPage', 'dynamicPage.create', 'dynamicPage.edit']) ? 'active' : null) }}
        href="{{ route('dynamicPages') }}"
            title="@lang('dynamic-pages.nav.dynamicPages')">
    <i class="fas fa-columns fa-fw"></i>
    @lang('dynamic-pages.nav.dynamicPages')
    </a>
</li>
