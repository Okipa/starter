@if(multilingual())
    <div class="dropdown {{ ! empty($containerClasses) ? implode(' ', $containerClasses) : '' }}">
        <a href=""
           class="dropdown-toggle {{ ! empty($dropdownLabelClasses) ? implode(' ', $dropdownLabelClasses) : '' }}"
           id="language-selector"
           data-toggle="dropdown"
           aria-haspopup="true"
           aria-expanded="false">
            <i class="fas fa-language fa-fw"></i>
            @lang('Language')
        </a>
        <div class="dropdown-menu {{ ! empty($dropdownMenuClasses) ? implode(' ', $dropdownMenuClasses) : '' }}"
             aria-labelledby="language-selector">
            @foreach(supportedLocales() as $localeKey => $locale)
                <a class="dropdown-item {{ app()->getLocale() === $locale ? 'active' : ''}} {{ ! empty($dropDownLinkClasses) ? implode(' ', $dropDownLinkClasses) : '' }}"
                   rel="alternate"
                   hreflang="{{ $localeKey }}"
                   href="{{ route(Route::current()->getName(), Route::current()->parameters(), true, $localeKey) }}">
                    <i class="fas fa-caret-right fa-fw"></i>
                    {{ $locale['name'] }}
                </a>
            @endforeach
        </div>
    </div>
@endif
