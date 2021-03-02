@shared
@include('components.common.cookies.cookie-consent')
@include('layouts.front.partials.google-tag-manager')
@include('sweetalert::alert')
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/front.js') }}"></script>
@brickablesJs
@isset($js)<script src="{{ $js }}"></script>@endisset
@stack('scripts')
