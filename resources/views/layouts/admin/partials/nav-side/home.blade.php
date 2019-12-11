@php
    $homePageActive = Str::contains(request()->route()->getName(), ['home.page.edit']);
    $subMenuActive = $homePageActive;
@endphp
<li class="nav-item">
    <a class="nav-link {{ $subMenuActive ? 'active' : null }}"
       href="#homeMenu"
       title="@lang('Home')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-home fa-fw"></i>
        @lang('Home')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="homeMenu" class="collapse list-unstyled {{ $subMenuActive ? 'show' : null }}">
        {{-- page --}}
        <li class="nav-item">
            <a class="nav-link load-on-click {{ $homePageActive ? 'active' : null }}"
               href="{{ route('home.page.edit') }}"
               title="@lang('Page')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('Page')
            </a>
        </li>
    </ul>
</li>
