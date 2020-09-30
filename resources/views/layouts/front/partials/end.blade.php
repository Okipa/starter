@include('layouts.common.partials.sweetalert')
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/front.js') }}"></script>
@brickablesJs
@isset($js)<script src="{{ $js }}"></script>@endisset
@stack('scripts')
