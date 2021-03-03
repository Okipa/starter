@shared
@include('sweetalert::alert')
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/front.js') }}"></script>
@include('layouts.front.partials.google-tag-manager')
@brickablesJs
@isset($js)<script src="{{ $js }}"></script>@endisset
@stack('scripts')
