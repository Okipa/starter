<li class="nav-item">
    <a class="nav-link{{ currentRouteIs('pages.index')
        || currentRouteIs('page.create')
        || currentRouteIs('page.edit')
        || optional(Brickables::getModelFromRequest())->getMorphClass() === App\Models\Pages\Page::class ? ' active' : null }}"
       href="{{ route('pages.index') }}"
       title="@lang('Pages')">
        <i class="fas fa-file-alt fa-fw"></i>
        @lang('Pages')
    </a>
</li>
