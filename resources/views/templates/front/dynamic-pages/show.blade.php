@extends('layouts.front.full')

@section('template')
    <div id="page" class="container d-flex flex-grow-1 my-4 py-4">
        <div class="d-flex flex-column">
            <h1 class="text-primary mb-5">{{ $dynamicPage->title }}</h1>
            <div class="text">
                @foreach ($dynamicPage->blocks as $block)
                    @include('templates.front.dynamic-pages.blocks.' . $block->block_id, [ 'blockable' => $block->blockable ])
                @endforeach
            </div>
        </div>
    </div>
@endsection
