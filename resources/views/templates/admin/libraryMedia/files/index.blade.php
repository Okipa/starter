@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @lang('breadcrumbs.parent.index', ['parent' => __('Media library'), 'entity' => __('Files')])
    </h1>
    <hr>
    <div class="card">
        <div class="card-header">
            <h2 class="m-0">
                @lang('List')
            </h2>
        </div>
        <div class="card-body">
            <form class="d-flex justify-content-end"
                  action="{{ route('libraryMedia.files.index') }}"
                  novalidate>
                @foreach($request->except('category_id') as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                {{ select()->name('category_id')
                    ->prepend('<i class="fas fa-tags fa-fw"></i>')
                    ->label(false)
                    ->options((new App\Models\LibraryMedia\LibraryMediaCategory)->get()->map(fn(App\Models\LibraryMedia\LibraryMediaCategory $category) => ['id' => $category->id, 'name' => $category->name])->sortBy('name'), 'id', 'name')
                    ->selected('id', (int) $request->category_id)
                    ->componentHtmlAttributes(['data-selector']) }}
                {{ submitValidate()->prepend('<i class="fas fa-filter"></i>')->label(__('Filter'))->containerClasses(['ml-3']) }}
                @if($request->has('category_id'))
                    {{ buttonCancel()->route('libraryMedia.files.index')->prepend('<i class="fas fa-undo"></i>')->label(__('Reset'))->containerClasses(['ml-3']) }}
                @endif
            </form>
            {{ $table }}
        </div>
    </div>
@endsection
