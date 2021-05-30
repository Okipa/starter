<li class="nav-item">
    {{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
    <a class="nav-link{{ currentRouteIs('news.page.show') || currentRouteIs('news.article.show') ? ' active' : null }}"
       href="{{ route('news.page.show') }}"
       title="{{ __('News') }}">
        {{ __('News') }}
    </a>
</li>
