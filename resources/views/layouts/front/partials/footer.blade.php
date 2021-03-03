<footer id="footer" class="bg-light py-3">
    <div class="container">
        <div class="row d-flex flew-wrap justify-content-between">
            <span class="text-muted mx-3">
                <i class="fas fa-copyright fa-fw"></i>
                {{ config('app.name') }}
            </span>
            @if($termsOfServicePage = pages()->where('unique_key', 'terms_of_service_page')->first())
                <a class="mx-3{{ currentUrlIs(route('page.show', $termsOfServicePage)) ? ' active' : ' text-body' }}"
                   href="{{ route('page.show', $termsOfServicePage) }}"
                   title="{{ $termsOfServicePage->nav_title }}">
                    {{ $termsOfServicePage->nav_title }}
                </a>
            @endif
            @if($gdprPage = pages()->where('unique_key', 'gdpr_page')->first())
                <a class="mx-3{{ currentUrlIs(route('page.show', $gdprPage)) ? ' active' : ' text-body' }}"
                   href="{{ route('page.show', $gdprPage) }}"
                   title="{{ $gdprPage->nav_title }}">
                    {{ $gdprPage->nav_title }}
                </a>
            @endif
            <a id="change-cookie-preferences"
               class="mx-3 text-body"
               href=""
               title="{{ __('My cookie preferences') }}">
                {{ __('My cookie preferences') }}
            </a>
            <div class="mx-3">
                @if($facebookUrl = settings()->facebook)
                    <a class="mx-2" href="{{ $facebookUrl }}" title="{{ __('Facebook') }}" target="_blank" rel="noopener">
                        <i class="fab fa-facebook fa-2x fa-fw"></i>
                    </a>
                @endif
                @if($twitterUrl = settings()->twitter)
                    <a class="mx-2" href="{{ $twitterUrl }}" title="{{ __('Twitter') }}" target="_blank" rel="noopener">
                        <i class="fab fa-twitter fa-2x fa-fw"></i>
                    </a>
                @endif
                @if($instagramUrl = settings()->instagram)
                    <a class="mx-2" href="{{ $instagramUrl }}" title="{{ __('Instagram') }}" target="_blank" rel="noopener">
                        <i class="fab fa-instagram fa-2x fa-fw"></i>
                    </a>
                @endif
                @if($youtubeUrl = settings()->youtube)
                    <a class="mx-2" href="{{ $youtubeUrl }}" title="{{ __('Youtube') }}" target="_blank" rel="noopener">
                        <i class="fab fa-youtube fa-2x fa-fw"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>
