@if(session()->has('alert.config'))
    <script>
        app.swalConfig = JSON.parse(@json(session()->pull('alert.config'), JSON_THROW_ON_ERROR));
    </script>
@endif
