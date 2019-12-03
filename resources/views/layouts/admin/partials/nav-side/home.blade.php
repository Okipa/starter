@php
    $homePageActive = in_array(request()->route()->getName(), ['home.page.edit']);
    $homeSlidesActive = in_array(request()->route()->getName(), ['home.slides', 'home.slide.create', 'home.slide.edit']);
    $subMenuActive = $homePageActive || $homeSlidesActive;
@endphp
<li class="nav-item">
    <a{{ classTag('nav-link', $subMenuActive ? 'active' : null) }}
       href="#homeMenu"
       title="@lang('nav.admin.home')"
       data-toggle="collapse"
       role="button"
       aria-expanded="false"
       aria-controls="newsMenu">
        <i class="fas fa-home fa-fw"></i>
        @lang('nav.admin.home')
        <i class="fas fa-caret-down fa-fw"></i>
    </a>
    <ul id="homeMenu" {{ classTag(['collapse', 'list-unstyled', $subMenuActive ? 'show' : null]) }}>
        {{-- page --}}
        <li class="nav-item">
            <a{{ classTag(['nav-link', 'load-on-click', $homePageActive ? 'active' : null]) }}
               href="{{ route('home.page.edit') }}"
               title="@lang('nav.admin.articles')">
                <i class="fas fa-desktop fa-fw"></i>
                @lang('nav.admin.page')
            </a>
        </li>
        {{-- slides --}}
        <li class="nav-item">
            <a{{ classTag(['nav-link', 'load-on-click', $homeSlidesActive ? 'active' : null]) }}
               href="{{ route('home.slides') }}"
               title="@lang('nav.admin.categories')">
            <i class="fas fa-images fa-fw"></i>
                @lang('nav.admin.slides')
            </a>
        </li>
    </ul>
</li>
