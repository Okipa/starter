@php
    $libraryMediaCategoriesActive = in_array(request()->route()->getName(), ['libraryMedia.categories.index', 'libraryMedia.category.create', 'libraryMedia.category.edit']);
    $libraryMediaFilesActive = in_array(request()->route()->getName(), ['libraryMedia.files.index', 'libraryMedia.file.create', 'libraryMedia.file.edit']);
    $subMenuActive = $libraryMediaCategoriesActive || $libraryMediaFilesActive;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $subMenuActive ? 'active' : null }}"
        href="#libraryMediaMenu"
            title="@lang('Media library')"
            data-toggle="collapse"
            role="button"
            aria-expanded="false"
            aria-controls="newsMenu">
        <i class="fas fa-photo-video fa-fw"></i>
        @lang('Media library')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="libraryMediaMenu" class="collapse list-unstyled {{ $subMenuActive ? 'show' : null }}">
        {{-- categories --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $libraryMediaCategoriesActive ? 'active' : null }}"
                href="{{ route('libraryMedia.categories.index') }}"
                    title="@lang('Categories')">
                <i class="fas fa-tags fa-fw"></i>
                @lang('Categories')
            </a>
        </li>
        {{-- files --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $libraryMediaFilesActive ? 'active' : null }}"
               href="{{ route('libraryMedia.files.index') }}"
               title="@lang('Files')">
                    <i class="fas fa-copy fa-fw"></i>
                    @lang('Files')
            </a>
        </li>
    </ul>
</li>
