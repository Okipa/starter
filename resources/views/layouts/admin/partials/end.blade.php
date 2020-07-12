@include('layouts.common.partials.sweetalert')
<script type="text/javascript" src="{{ mix('/js/manifest.js') }}"></script>
<script type="text/javascript" src="{{ mix('/js/vendor.js') }}"></script>
<script type="text/javascript" src="{{ mix('/js/admin.js') }}"></script>
@brickablesJs
@isset($js)
    <script type="text/javascript" src="{{ $js }}"></script>
@endisset
@stack('scripts')
