@extends('layouts.front.full')
@section('template')
    {!! $pageContent->displayBricks() !!}
    @brickableResourcesCompute
@endsection
