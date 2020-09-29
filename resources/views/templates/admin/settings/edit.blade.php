@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-cogs fa-fw"></i>
        @lang('breadcrumbs.orphan.index', ['entity' => __('Settings')])
    </h1>
    <hr>
    <form method="POST" class="w-100" action="{{ route('settings.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        {{ submitUpdate() }}
        <p>
            @include('components.common.form.notice')
        </p>
        <div class="card-columns">
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Media')
                    </h2>
                </div>
                <div class="card-body">
                    @php($logo = $settings->getFirstMedia('icons'))
                    {{ inputFile()->name('icon')
                        ->value(optional($logo)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $logo]))
                        ->caption($settings->getMediaCaption('icons'))
                        ->containerHtmlAttributes(['required']) }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Tracking and property')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputText()->name('google_tag_manager_id')->model($settings)->prepend('<i class="fab fa-google"></i>') }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Contact')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputEmail()->name('email')->model($settings)->containerHtmlAttributes(['required']) }}
                    {{ inputTel()->name('phone_number')->model($settings)->containerHtmlAttributes(['required']) }}
                    {{ inputText()->name('address')->model($settings)->prepend('<i class="fas fa-map-marker"></i>')->containerHtmlAttributes(['required']) }}
                    {{ inputText()->name('zip_code')->model($settings)->prepend('<i class="fas fa-location-arrow"></i>')->containerHtmlAttributes(['required']) }}
                    {{ inputText()->name('city')->model($settings)->prepend('<i class="fas fa-thumbtack"></i>')->containerHtmlAttributes(['required']) }}
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h2 class="m-0">
                        @lang('Links')
                    </h2>
                </div>
                <div class="card-body">
                    {{ inputText()->name('facebook')->model($settings)->prepend('<i class="fab fa-facebook"></i>') }}
                    {{ inputText()->name('twitter')->model($settings)->prepend('<i class="fab fa-twitter"></i>') }}
                    {{ inputText()->name('instagram')->model($settings)->prepend('<i class="fab fa-instagram"></i>') }}
                    {{ inputText()->name('youtube')->model($settings)->prepend('<i class="fab fa-youtube"></i>') }}
                </div>
            </div>
        </div>
    </form>
@endsection
