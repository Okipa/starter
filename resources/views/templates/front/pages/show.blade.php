@extends('layouts.front.full')
@section('template')
    <div class="container my-5">
        <div class="row mb-5">
            <div class="col">
                <h1 class="text-primary">{{ $page->title }}</h1>
            </div>
        </div>
        {{ Brickables::bricks($page) }}
    </div>
@endsection
