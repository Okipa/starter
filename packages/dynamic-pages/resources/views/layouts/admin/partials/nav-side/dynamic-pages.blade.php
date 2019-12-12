<li class="nav-item">
    <a{{ classTag('nav-link', 'load-on-click', in_array($route, ['dynamic-pages::dynamicPages', 'dynamic-pages::dynamicPage.create', 'dynamic-pages::dynamicPage.edit']) ? 'active' : null) }}
        href
    ="{{ route('dynamic-pages::dynamicPages') }}"
    title="@lang('dynamic-pages::nav.dynamicPages')">
    <i class="fas fa-columns fa-fw"></i>
    @lang('dynamic-pages::nav.dynamicPages')
    </a>
</li>
