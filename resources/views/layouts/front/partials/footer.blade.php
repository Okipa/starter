<footer id="footer" class="bg-light py-3">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <span class="text-muted">
                <i class="fas fa-copyright fa-fw"></i>
                {{ config('app.name') }}
            </span>
            @if($termsOfServicePage = pages()->where('slug', 'terms-of-service-page')->first())
                <a class="text-body"
                   href="{{ route('page.show', $termsOfServicePage->url) }}"
                   title="{{ $termsOfServicePage->title }}">
                    {{ $termsOfServicePage->title }}
                </a>
            @endif
            @if($gdprPage = pages()->where('slug', 'gdpr-page')->first())
                <a class="text-body"
                   href="{{ route('page.show', $gdprPage->url) }}"
                   title="{{ $gdprPage->title }}">
                    {{ $gdprPage->title }}
                </a>
            @endif
            <div>
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
