<footer id="footer" class="bg-light py-3">
    <div class="container">
        <div class="row d-flex flew-wrap justify-content-between">
            <span class="text-muted mx-3">
                <i class="fas fa-copyright fa-fw"></i>
                {{ config('app.name') }}
            </span>
            @if($termsOfServicePage = pages()->where('unique_key', 'terms_of_service_page')->first())
                <a class="mx-3{{ currentUrlIs(route('page.show', $termsOfServicePage->slug)) ? ' active' : ' text-body' }}"
                   href="{{ route('page.show', $termsOfServicePage->slug) }}"
                   title="{{ $termsOfServicePage->nav_title }}">
                    {{ $termsOfServicePage->nav_title }}
                </a>
            @endif
            @if($gdprPage = pages()->where('unique_key', 'gdpr_page')->first())
                <a class="mx-3{{ currentUrlIs(route('page.show', $gdprPage->slug)) ? ' active' : ' text-body' }}"
                   href="{{ route('page.show', $gdprPage->slug) }}"
                   title="{{ $gdprPage->nav_title }}">
                    {{ $gdprPage->nav_title }}
                </a>
            @endif
            <div class="mx-3">
                @if($facebookUrl = settings()->facebook)
                    <a class="new-window" href="{{ $facebookUrl }}" title="@lang('Facebook')">
                        <i class="fab fa-facebook fa-fw"></i>
                    </a>
                @endif
                @if($twitterUrl = settings()->twitter)
                    <a class="new-window" href="{{ $twitterUrl }}" title="@lang('Twitter')">
                        <i class="fab fa-twitter fa-fw"></i>
                    </a>
                @endif
                @if($instagramUrl = settings()->instagram)
                    <a class="new-window" href="{{ $instagramUrl }}" title="@lang('Instagram')">
                        <i class="fab fa-instagram fa-fw"></i>
                    </a>
                @endif
                @if($youtubeUrl = settings()->youtube)
                    <a class="new-window" href="{{ $youtubeUrl }}" title="@lang('Youtube')">
                        <i class="fab fa-youtube fa-fw"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>
