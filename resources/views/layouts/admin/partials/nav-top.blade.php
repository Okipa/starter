<ul id="topnav" class="navbar-nav nav bg-dark flex-column flex-grow-1 align-content-end align-items-end">
    @include('layouts.admin.partials.nav-top.telescope')
    @include('layouts.admin.partials.nav-top.horizon')
    {{--ToDo: remove the line below if your app is not multilingual --}}
    @include('layouts.admin.partials.nav-top.language')
    @include('layouts.admin.partials.nav-top.user-config')
</ul>
