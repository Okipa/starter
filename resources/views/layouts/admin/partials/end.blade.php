@include('layouts.common.partials.sweetalert')
<script src="{{ mix('/js/manifest.js') }}" defer></script>
<script src="{{ mix('/js/vendor.js') }}" defer></script>
<script src="{{ mix('/js/admin.js') }}" defer></script>
@brickablesJs
@isset($js)<script src="{{ $js }}" defer></script>@endisset
@stack('scripts')
