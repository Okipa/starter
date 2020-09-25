@extends('layouts.admin.empty')
@section('template')
    @if(session('status'))
        @php(alert()->html(__('Success'), session('status'), 'success')->showConfirmButton())
    @endif
    <div class="container d-flex">
        <div class="row d-flex flex-grow-1 align-items-center justify-content-center">
            <div class="col-sm-8 col-md-6 col-lg-4 py-3">
                <div class="d-flex flex-column">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
@endsection
