{{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
<li class="nav-item{{ currentRouteIs('news.page.show')
    || currentRouteIs('news.article.show') ? ' active' : null }}">
    <a class="nav-link"
       href="{{ route('news.page.show') }}"
       title="{{ __('News') }}">
        {{ __('News') }}
    </a>
</li>
