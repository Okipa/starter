<li class="nav-item {{ Str::contains(request()->route()->getName(), ['news', 'news.article.show']) ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('news') }}"
       title="@lang('News')">
        @lang('News')
    </a>
</li>
