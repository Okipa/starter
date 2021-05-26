{{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
<li class="nav-item{{ currentRouteIs('contact.page.show') ? ' active' : null }}">
    <a class="nav-link"
       href="{{ route('contact.page.show') }}"
       title="{{ __('Contact') }}">
        {{ __('Contact') }}
    </a>
</li>
