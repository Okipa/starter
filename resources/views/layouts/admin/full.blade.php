@extends('layouts.common.partials.html')
@section('layout')
    @include('layouts.admin.partials.head')
    <body id="admin" class="d-flex flex-column">
        @include('layouts.common.partials.noscript')
        <div id="layout" class="d-flex flex-grow-1 flex-column position-relative">
            @include('layouts.admin.partials.nav')
            <div id="template">
                @yield('template')
            </div>
        </div>
    </body>
    @include('layouts.admin.partials.end')
@endsection
