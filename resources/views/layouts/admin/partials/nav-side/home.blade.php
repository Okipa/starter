@php
    // ToDo: replace `currentRouteIs` by `Route::is` if your app is not multilingual.
    $homePageActive = currentRouteIs('home.page.edit')
        || optional(Brickables::getModelFromRequest())->unique_key === 'home_page_content'
        || currentRouteIs('brick.carousel.slide.create')
        || currentRouteIs('brick.carousel.slide.edit');
    $subMenuActive = $homePageActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
       href="#home-menu"
       title="{{ __('Home') }}"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="home-menu">
        <i class="fas fa-home fa-fw"></i>
        {{ __('Home') }}
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="home-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link {{ $homePageActive ? 'active' : null }}"
               href="{{ route('home.page.edit') }}"
               title="{{ __('Page') }}">
                <i class="fas fa-desktop fa-fw"></i>
                {{ __('Page') }}
            </a>
        </li>
    </ul>
</li>
