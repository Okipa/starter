@php
    $homePageActive = currentRouteIs('home.page.edit')
        || optional(Brickables::getModelFromRequest())->unique_key === 'home_page_content';
    $subMenuActive = $homePageActive;
@endphp
<li class="nav-item">
    <a class="nav-link{{ $subMenuActive ? ' active' : null }}"
       href="#home-menu"
       title="@lang('Home')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="home-menu">
        <i class="fas fa-home fa-fw"></i>
        @lang('Home')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="home-menu" class="collapse list-unstyled{{ $subMenuActive ? ' show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link {{ $homePageActive ? 'active' : null }}"
               href="{{ route('home.page.edit') }}"
               title="@lang('Page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('Page')
            </a>
        </li>
    </ul>
</li>
