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
                @php($logo = $settings->getFirstMedia('icon'))
                {{ bsFile()->name('icon')
                    ->value(optional($logo)->file_name)
                    ->uploadedFile(function() use ($logo) {
                        return $logo
                            ? image()->src($logo->getUrl('thumb'))
                                ->linkUrl($logo->getUrl())
                                ->containerClasses(['mb-2'])
                            : null;
                    })
                    ->legend((new \App\Models\Settings)->constraintsLegend('icon')) }}
                <h3 class="pt-4">@lang('Contact')</h3>
                {{ bsEmail()->name('email')->model($settings)->containerHtmlAttributes(['required']) }}
                {{ bsTel()->name('phone_number')->model($settings)->containerHtmlAttributes(['required']) }}
                {{ bsText()->name('address')->model($settings)->prepend('<i class="fas fa-map-marker"></i>') }}
                {{ bsText()->name('zip_code')->model($settings)->prepend('<i class="fas fa-location-arrow"></i>') }}
                {{ bsText()->name('city')->model($settings)->prepend('<i class="fas fa-thumbtack"></i>') }}
                <h3 class="pt-4">@lang('Links')</h3>
                {{ bsText()->name('facebook')->model($settings)->prepend('<i class="fab fa-facebook"></i>') }}
                {{ bsText()->name('twitter')->model($settings)->prepend('<i class="fab fa-twitter"></i>') }}
                {{ bsText()->name('instagram')->model($settings)->prepend('<i class="fab fa-instagram"></i>') }}
                {{ bsText()->name('youtube')->model($settings)->prepend('<i class="fab fa-youtube"></i>') }}
                <h3 class="pt-4">@lang('Tracking')</h3>
                {{ bsText()->name('google_tag_manager_id')->model($settings)->prepend('<i class="fas fa-tag"></i>') }}
                <div class="d-flex pt-4">
                    {{ bsUpdate() }}
                </div>

            </div>
        </div>
    </form>
@endsection
