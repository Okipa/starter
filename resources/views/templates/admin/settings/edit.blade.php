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
        @include('components.common.form.notice')
        <div class="card">
            <div class="card-header">
                <h2 class="m-0">
                    @lang('Data')
                </h2>
            </div>
            <div class="card-body">
                <h3>@lang('Identity')</h3>
                @php($logo = $settings->getFirstMedia('icons'))
                {{ inputFile()->name('icon')
                    ->value(optional($logo)->file_name)
                    ->uploadedFile(fn() => $logo ? image()->src($logo->getUrl('thumb'))->linkUrl($logo->getUrl())->linkTitle($logo->name) : null)
                    ->caption($settings->getMediaCaption('icons')) }}
                <h3>@lang('Contact')</h3>
                {{ inputEmail()->name('email')->model($settings)->containerHtmlAttributes(['required']) }}
                {{ inputTel()->name('phone_number')->model($settings)->containerHtmlAttributes(['required']) }}
                {{ inputText()->name('address')->model($settings)->prepend('<i class="fas fa-map-marker"></i>') }}
                {{ inputText()->name('zip_code')->model($settings)->prepend('<i class="fas fa-location-arrow"></i>') }}
                {{ inputText()->name('city')->model($settings)->prepend('<i class="fas fa-thumbtack"></i>') }}
                <h3>@lang('Links')</h3>
                {{ inputText()->name('facebook')->model($settings)->prepend('<i class="fab fa-facebook"></i>') }}
                {{ inputText()->name('twitter')->model($settings)->prepend('<i class="fab fa-twitter"></i>') }}
                {{ inputText()->name('instagram')->model($settings)->prepend('<i class="fab fa-instagram"></i>') }}
                {{ inputText()->name('youtube')->model($settings)->prepend('<i class="fab fa-youtube"></i>') }}
                <h3>@lang('Tracking and property')</h3>
                {{ inputText()->name('google_tag_manager_id')->model($settings)->prepend('<i class="fab fa-google"></i>') }}
                <div class="d-flex pt-4">
                    {{ submitUpdate() }}
                </div>
            </div>
        </div>
    </form>
@endsection
