@extends('layouts.front.empty')
@section('template')
    @php($maintenanceMode = $exception->getStatusCode() === 503)
    <div id="error" class="container d-flex flex-grow-1 align-items-center justify-content-center">
        <div class="row">
            <div class="text-center">
                <div class="mx-auto mb-4">
                    @include('components.common.language.selector', [
                        'containerClasses' => ['text-right'],
                        'dropdownLabelClasses' => ['btn', 'btn-link'],
                        'dropdownMenuClasses' => ['dropdown-menu-right']
                    ])
                    @if($icon = $settings->getFirstMedia('icon'))
                        {{ $icon('auth') }}
                    @endif
                </div>
                <i class="fas fa-5x fa-exclamation-triangle fa-fw text-danger"></i>
                <h1 class="h3 font-weight-normal mt-3">
                    @if($maintenanceMode && $exception->getMessage())
                        @lang('errors.message.' . $exception->getStatusCode())
                    @else
                        @lang('errors.title') {{ $exception->getStatusCode() }}
                    @endif
                </h1>
                <p class="h5">
                    @if($maintenanceMode && $exception->getMessage())
                        {{ $exception->getMessage() }}
                    @else
                        @lang('errors.message.' . $exception->getStatusCode())
                    @endif
                </p>
                {{ bsBack()->route('home')->label($maintenanceMode
                    ? __('static.action.retry')
                    : __('Back to home page'))->containerClasses(['mt-5']) }}
            </div>
        </div>
    </div>
@endsection

