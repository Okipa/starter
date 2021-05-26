<li class="nav-item">
    {{-- ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual --}}
    <a class="nav-link{{ currentRouteIs('pages.index')
        || currentRouteIs('page.create')
        || currentRouteIs('page.edit')
        || optional(Brickables::getModelFromRequest())->getMorphClass() === App\Models\Pages\Page::class ? ' active' : null }}"
       href="{{ route('pages.index') }}"
       title="{{ __('Free pages') }}">
        <i class="fas fa-file-alt fa-fw"></i>
        {{ __('Free pages') }}
    </a>
</li>
