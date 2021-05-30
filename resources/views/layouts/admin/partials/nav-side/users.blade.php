<li class="nav-item">
    {{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
    <a class="nav-link{{ currentRouteIs('users.index')
        || currentRouteIs('user.create')
        || currentRouteIs('user.edit') ? ' active' : null }}"
       href="{{ route('users.index') }}"
       title="{{ __('Users') }}">
        <i class="fas fa-users fa-fw"></i>
        {{ __('Users') }}
    </a>
</li>
