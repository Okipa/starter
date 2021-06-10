@extends('layouts.front.full')
@section('template')
    {!! $page->displayBricks() !!}
    @brickableResourcesCompute
@endsection
