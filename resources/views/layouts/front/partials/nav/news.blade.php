<li class="nav-item{{ currentRouteIs('news.page.show') || currentRouteIs('news.article.show') ? ' active' : null }}">
    <a class="nav-link"
       href="{{ route('news.page.show') }}"
       title="@lang('News')">
        @lang('News')
    </a>
</li>
