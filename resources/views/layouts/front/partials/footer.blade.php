<footer id="footer" class="bg-light py-3">
    <div class="container">
        <div class="row d-flex justify-content-between">
            <span class="text-muted">
                <i class="fas fa-copyright fa-fw"></i>
                {{ config('app.name') }}
            </span>
            @if($termsOfServicePage)
                <a class="text-body"
                   href="{{ route('simplePage.show', $termsOfServicePage->url) }}"
                   title="{{ $termsOfServicePage->title }}">
                    {{ $termsOfServicePage->title }}
                </a>
            @endif
            @if($gdprPage)
                <a class="text-body"
                   href="{{ route('simplePage.show', $gdprPage->url) }}"
                   title="{{ $gdprPage->title }}">
                    {{ $gdprPage->title }}
                </a>
            @endif
            <div>
                @if($settings->facebook)
                    <a class="new-window" href="{{ $settings->facebook }}" title="Facebook">
                        <i class="fab fa-facebook fa-fw"></i>
                    </a>
                @endif
                @if($settings->twitter)
                    <a class="new-window" href="{{ $settings->twitter }}" title="Twitter">
                        <i class="fab fa-twitter fa-fw"></i>
                    </a>
                @endif
                @if($settings->instagram)
                    <a class="new-window" href="{{ $settings->instagram }}" title="Instagram">
                        <i class="fab fa-instagram fa-fw"></i>
                    </a>
                @endif
                @if($settings->youtube)
                    <a class="new-window" href="{{ $settings->youtube }}" title="Youtube">
                        <i class="fab fa-youtube fa-fw"></i>
                    </a>
                @endif
            </div>
        </div>
    </div>
</footer>
