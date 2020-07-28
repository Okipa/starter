@php
    $newsPageActive = currentRouteIs('news.page.edit')
        || optional(Brickables::getModelFromRequest())->unique_key === 'news_page_content';
    $newsCategoriesActive = currentRouteIs('news.categories.index')
        || currentRouteIs('news.category.create')
        || currentRouteIs('news.category.edit');
    $newsArticlesActive = currentRouteIs('news.articles.index')
        || currentRouteIs('news.article.create')
        || currentRouteIs('news.article.edit');
    $subMenuActive = $newsPageActive
        || $newsArticlesActive
        || $newsCategoriesActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
       href="#news-menu"
       title="@lang('News')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="news-menu">
        <i class="fas fa-newspaper fa-fw"></i>
        @lang('News')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="news-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link{{ $newsPageActive ? ' active' : null }}"
               href="{{ route('news.page.edit') }}"
               title="@lang('Page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('Page')
            </a>
        </li>
        {{-- categories --}}
        <li class="nav-item">
            <a class="nav-link{{ $newsCategoriesActive ? ' active' : null }}"
               href="{{ route('news.categories.index') }}"
               title="@lang('Categories')">
                <i class="fas fa-tags fa-fw"></i>
                @lang('Categories')
            </a>
        </li>
        {{-- articles --}}
        <li class="nav-item">
            <a class="nav-link{{ $newsArticlesActive ? ' active' : null }}"
               href="{{ route('news.articles.index') }}"
               title="@lang('Articles')">
                <i class="fas fa-paper-plane fa-fw"></i>
                @lang('Articles')
            </a>
        </li>
    </ul>
</li>
