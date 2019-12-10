@php
    $newsCategoriesActive = in_array(request()->route()->getName(), ['news.categories', 'news.category.create', 'news.category.edit']);
    $newsArticlesActive = in_array(request()->route()->getName(), ['news.articles', 'news.article.create', 'news.article.edit']);
    $subMenuActive = $newsArticlesActive || $newsCategoriesActive;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $subMenuActive ? 'active' : null }}"
       href="#newsMenu"
       title="@lang('nav.admin.news')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-newspaper fa-fw"></i>
        @lang('nav.admin.news')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="newsMenu" class="collapse list-unstyled {{ $subMenuActive ? 'show' : null }}">
        {{-- categories --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $newsCategoriesActive ? 'active' : null }}"
               href="{{ route('news.categories') }}"
               title="@lang('nav.admin.categories')">
                <i class="fas fa-tags fa-fw"></i>
                @lang('nav.admin.categories')
            </a>
        </li>
        {{-- articles --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $newsArticlesActive ? 'active' : null }}"
               href="{{ route('news.articles') }}"
               title="@lang('nav.admin.articles')">
                <i class="fas fa-paper-plane fa-fw"></i>
                @lang('nav.admin.articles')
            </a>
        </li>
    </ul>
</li>
