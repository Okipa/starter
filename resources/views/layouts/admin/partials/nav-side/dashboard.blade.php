<li class="nav-item">
    {{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
    <a class="nav-link{{ currentRouteIs('dashboard.index') ? ' active' : null }}"
       href="{{ route('dashboard.index') }}"
       title="{{ __('Dashboard') }}">
        <i class="fas fa-tachometer-alt fa-fw"></i>
        {{ __('Dashboard') }}
    </a>
</li>
