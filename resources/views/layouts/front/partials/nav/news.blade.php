<li class="nav-item {{ in_array(request()->route()->getName(), ['news', 'news.article.show']) ? 'active' : null }}">
    <a class="nav-link"
       href="{{ route('news') }}"
       title="@lang('News')">
        <i class="fas fa-newspaper fa-fw"></i>
        @lang('News')
    </a>
</li>
