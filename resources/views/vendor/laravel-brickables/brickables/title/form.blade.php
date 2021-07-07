@extends('laravel-brickables::admin.form.layout')
@section('form_body')
    <x-common.forms.notice class="mt-3"/>
    <div class="row mb-n3" data-masonry>
        <div class="col-xl-6 mb-3">
            <x-admin.forms.card title="Configuration">
                @bind($brick->data)
                    <x-form::select name="type"
                                    :options="array_map(fn($type) => __($type['label']), App\View\Components\Front\Title::TYPES)"
                                    multiple
                                    required/>
                    <x-form::select name="style"
                                    :options="array_map(fn($type) => __($type['label']), App\View\Components\Front\Title::STYLES)"
                                    multiple
                                    required/>
                    <x-form::input name="title" :locales="supportedLocaleKeys()" required/>
                @endbind()
            </x-admin.forms.card>
        </div>
    </div>
@endsection
