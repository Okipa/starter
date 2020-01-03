<script type="text/javascript" src="{{ mix('/js/manifest.js') }}" defer></script>
<script type="text/javascript" src="{{ mix('/js/vendor.js') }}" defer></script>
<script type="text/javascript" src="{{ mix('/js/admin.js') }}" defer></script>
@isset($js)
    <script type="text/javascript" src="{{ $js }}" defer></script>
@endif
