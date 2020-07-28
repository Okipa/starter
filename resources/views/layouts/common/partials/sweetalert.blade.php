@if(session()->has('alert.config'))
    <script>
        app.swalConfig = JSON.parse(@json(session()->pull('alert.config')));
    </script>
@endif
