@extends('layouts.front.full')
@section('template')
    <div class="mb-5">
        {!! $pageContent->displayBricks() !!}
        @brickableResourcesCompute
    </div>
@endsection
