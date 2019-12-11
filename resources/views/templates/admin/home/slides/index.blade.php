@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-images fa-fw"></i>
        @lang('breadcrumbs.parent.index', [
            'parent' => __('Home'),
            'entity' => __('Slides'),
        ])
    </h1>
    <hr>
    <div class="card">
        <div class="card-header">
            <h2 class="m-0">
                @lang('List')
            </h2>
        </div>
        <div class="card-body">
            {{ $table }}
        </div>
    </div>
@endsection
