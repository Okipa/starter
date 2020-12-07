@include('sweetalert::alert')
<script src="{{ mix('/js/manifest.js') }}"></script>
<script src="{{ mix('/js/vendor.js') }}"></script>
<script src="{{ mix('/js/admin.js') }}"></script>
@brickablesJs
@isset($js)<script src="{{ $js }}"></script>@endisset
@stack('scripts')
