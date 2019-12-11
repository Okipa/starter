@php
    $newsCategoriesActive = in_array(request()->route()->getName(), ['news.categories', 'news.category.create', 'news.category.edit']);
    $newsArticlesActive = in_array(request()->route()->getName(), ['news.articles', 'news.article.create', 'news.article.edit']);
    $subMenuActive = $newsArticlesActive || $newsCategoriesActive;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $subMenuActive ? 'active' : null }}"
       href="#newsMenu"
       title="@lang('News')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-newspaper fa-fw"></i>
        @lang('News')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="newsMenu" class="collapse list-unstyled {{ $subMenuActive ? 'show' : null }}">
        {{-- categories --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $newsCategoriesActive ? 'active' : null }}"
               href="{{ route('news.categories.index') }}"
               title="@lang('Categories')">
                <i class="fas fa-tags fa-fw"></i>
                @lang('Categories')
            </a>
        </li>
        {{-- articles --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $newsArticlesActive ? 'active' : null }}"
               href="{{ route('news.articles.index') }}"
               title="@lang('Articles')">
                <i class="fas fa-paper-plane fa-fw"></i>
                @lang('Articles')
            </a>
        </li>
    </ul>
</li>
