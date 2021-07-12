@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-cogs fa-fw"></i>
        {{ __('breadcrumbs.orphan.index', ['entity' => __('Settings')]) }}
    </h1>
    <hr>
    <form method="POST"
          action="{{ route('settings.update') }}"
          enctype="multipart/form-data"
          novalidate>
        @csrf
        @method('PUT')
        {{ submitUpdate() }}
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Media') }}">
                    @php($logo = $settings->getFirstMedia('logo_squared'))
                    {{ inputFile()->name('logo_squared')
                        ->value(optional($logo)->file_name)
                        ->uploadedFile(fn() => view('components.admin.media.thumb', ['image' => $logo]))
                        ->showRemoveCheckbox(false)
                        ->caption($settings->getMediaCaption('logo_squared')) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Contact') }}">
                    {{ inputEmail()->name('email')
                        ->model($settings)
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'email']) }}
                    {{ inputTel()->name('phone_number')
                        ->model($settings)
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'tel']) }}
                    {{ inputText()->name('address')
                        ->model($settings)
                        ->prepend('<i class="fas fa-map-marker"></i>')
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'street-address']) }}
                    {{ inputText()->name('zip_code')
                        ->model($settings)
                        ->prepend('<i class="fas fa-location-arrow"></i>')
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'postal-code']) }}
                    {{ inputText()->name('city')
                        ->model($settings)
                        ->prepend('<i class="fas fa-thumbtack"></i>')
                        ->componentHtmlAttributes(['required', 'autocomplete' => 'locality']) }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Links') }}">
                    {{ inputText()->name('facebook_url')->model($settings)->prepend('<i class="fab fa-facebook"></i>') }}
                    {{ inputText()->name('twitter_url')->model($settings)->prepend('<i class="fab fa-twitter"></i>') }}
                    {{ inputText()->name('instagram_url')->model($settings)->prepend('<i class="fab fa-instagram"></i>') }}
                    {{ inputText()->name('youtube_url')->model($settings)->prepend('<i class="fab fa-youtube"></i>') }}
                </x-admin.forms.card>
            </div>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Tracking and property') }}">
                    {{ inputUrl()->name('matomo_url')->model($settings)->prepend('<i class="fas fa-chart-line"></i>') }}
                    {{ inputText()->name('matomo_id_site')->model($settings)->prepend('<i class="fas fa-chart-line"></i>') }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
