{{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
<li class="nav-item{{ currentRouteIs('home.page.show') ? ' active' : null }}">
    <a class="nav-link"
       href="{{ route('home.page.show') }}"
       title="{{ __('Home') }}">
        {{ __('Home') }}
    </a>
</li>
