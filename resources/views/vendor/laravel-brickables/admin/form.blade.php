@extends('layouts.admin.full')
@section('template')
    @include('laravel-brickables::admin.partials.form-title')
    <form method="POST" action="{{ $brick ? $brickable->getUpdateRoute($brick) : $brickable->getStoreRoute() }}">
        @csrf
        @if($brick)@method('PUT')@endif
        @include('components.common.form.notice')
        <input type="hidden" name="model_id" value="{{ $model->id }}">
        <input type="hidden" name="model_type" value="{{ get_class($model) }}">
        <input type="hidden" name="brickable_type" value="{{ get_class($brickable) }}">
        <input type="hidden" name="admin_panel_url" value="{{ $adminPanelUrl }}">
        @yield('inputs')
        @include('laravel-brickables::admin.partials.form-actions')
    </form>
@endsection

