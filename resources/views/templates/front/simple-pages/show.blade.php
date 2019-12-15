@extends('layouts.front.full')
@section('template')
    <div id="page" class="container d-flex flex-grow-1 my-4 py-4">
        <div class="d-flex flex-column">
            <h1 class="text-primary mb-5">{{ $page->title }}</h1>
            <div class="text">
                {!! (new Parsedown)->text($page->description) !!}
            </div>
        </div>
    </div>
@endsection
