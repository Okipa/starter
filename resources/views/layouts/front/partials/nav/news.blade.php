<li class="nav-item {{ in_array(request()->route()->getName(), ['news', 'news.article.show']) ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('news') }}"
       title="@lang('nav.front.news')">
        @lang('nav.front.news')
    </a>
</li>
