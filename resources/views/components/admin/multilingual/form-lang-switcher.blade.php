@if(multilingual())
    <ul id="form-lang-switcher" class="nav nav-tabs my-3">
        @foreach(supportedLocales() as $localeKey => $locale)
            <li class="nav-item">
                <a class="nav-link"
                   href=""
                   data-locale="{{ $localeKey }}">
                    @lang($locale['name'])
                </a>
            </li>
        @endforeach
    </ul>
@endif
