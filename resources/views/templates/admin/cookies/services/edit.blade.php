@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-cookie-bite fa-fw"></i>
        @if($cookieService)
            {{ __('breadcrumbs.parent.edit', ['parent' => __('Cookies'), 'entity' => __('Services'), 'detail' => $cookieService->title]) }}
        @else
            {{ __('breadcrumbs.parent.create', ['parent' => __('Cookies'), 'entity' => __('Services')]) }}
        @endif
    </h1>
    <hr>
    <form method="POST"
          action="{{ $cookieService ? route('cookie.service.update', $cookieService) : route('cookie.service.store') }}"
          novalidate>
        @csrf
        @if($cookieService)
            @method('PUT')
        @endif
        <div class="d-flex">
            {{ buttonBack()->route('cookie.services.index')->containerClasses(['mr-3']) }}
            @if($cookieService){{ submitUpdate() }}@else{{ submitCreate() }}@endif
        </div>
        <x-common.forms.notice class="mt-3"/>
        <div class="row mb-n3" data-masonry>
            <div class="col-xl-6 mb-3">
                <x-admin.forms.card title="{{ __('Identity') }}">
                    {{ inputText()->name('title')
                        ->model($cookieService)
                        ->componentHtmlAttributes(['required'])
                        ->caption(__('The displayed service title on the user consent pop-in.')) }}
                    {{ inputText()->name('name')
                        ->model($cookieService)
                        ->componentHtmlAttributes(['required', 'data-kebabcase', 'data-autofill-from' => '#text-title'])
                        ->caption(__('The unique service name, which is used to associate the user consent with a third-party script.')) }}
                    {{ inputText()->name('purposes')
                        ->model($cookieService)
                        ->componentHtmlAttributes(['required'])
                        ->caption(__('The usage categories of the service. Each purpose should be separated by a ";".')) }}
                    {{ textarea()->name('cookies_config') }}
                    {{ inputSwitch()->name('active') }}
                </x-admin.forms.card>
            </div>
        </div>
    </form>
@endsection
