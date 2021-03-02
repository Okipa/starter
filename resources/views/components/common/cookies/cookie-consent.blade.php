{{-- For more information: https://www.cookieconsent.com --}}
@php($gdprPage = pages()->where('unique_key', 'gdpr_page')->first())
<link rel="preconnect dns-prefetch" href="https://www.cookieconsent.com" crossorigin>
{{--<script src="//www.cookieconsent.com/releases/3.1.0/cookie-consent.js"></script>--}}
{{--<script>document.addEventListener('DOMContentLoaded', function () {cookieconsent.run({'notice_banner_type':'simple','consent_type':'express','palette':'light','language':'{{ app()->getLocale() }}','website_name':'{{ config('app.name') }}','cookies_policy_url':'{{ $gdprPage ? route('page.show', $gdprPage) : null }}','change_preferences_selector':''});});</script>--}}
{{--<noscript>ePrivacy and GPDR Cookie Consent by <a href="https://www.CookieConsent.com/" rel="nofollow noopener">Cookie Consent</a></noscript>--}}

<!-- Cookie Consent by https://www.CookieConsent.com -->
<script type="text/javascript" src="//www.cookieconsent.com/releases/3.1.0/cookie-consent.js"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        cookieconsent.run({"notice_banner_type":"headline","consent_type":"express","palette":"dark","language":"en"});
    });
</script>
<noscript>ePrivacy and GPDR Cookie Consent by <a href="https://www.CookieConsent.com/" rel="nofollow noopener">Cookie Consent</a></noscript>
<!-- End Cookie Consent by https://www.CookieConsent.com -->
