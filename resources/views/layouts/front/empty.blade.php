@extends('layouts.common.partials.html')
@section('layout')
    @include('layouts.front.partials.head')
    <body id="front" class="d-flex flex-column">
        @include('layouts.common.partials.noscript')
        <div id="layout" class="d-flex flex-grow-1 position-relative">
            @yield('template')
        </div>
    </body>
    @include('layouts.front.partials.end')
@endsection
