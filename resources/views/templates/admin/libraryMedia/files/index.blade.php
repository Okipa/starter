@extends('layouts.admin.full')
@section('template')
    <h1>
        <i class="fas fa-photo-video fa-fw"></i>
        @lang('breadcrumbs.orphan.index', ['entity' => __('Media library')])
    </h1>
    <hr>
    <div class="card">
        <div class="card-header">
            <h2 class="m-0">
                @lang('List')
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('libraryMedia.files.index') }}" class="d-flex justify-content-end">
                @foreach($request->except('category_id') as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach
                {{ select()->name('category_id')
                    ->prepend('<i class="fas fa-tags fa-fw"></i>')
                    ->label(false)
                    ->options((new \App\Models\LibraryMedia\LibraryMediaCategory)->get()->map(function($category){
                        $array = $category->toArray();
                        $array['name'] = $category->name;

                        return $array;
                    })->sortBy('name'), 'id', 'name')
                    ->selected('id', $request->category_id) }}
                {{ submitValidate()->prepend('<i class="fas fa-filter"></i>')->label(__('Filter'))->containerClasses(['ml-3']) }}
                @if($request->has('category_id'))
                    {{ buttonCancel()->route('libraryMedia.files.index')->prepend('<i class="fas fa-undo"></i>')->label(__('Reset'))->containerClasses(['ml-3']) }}
                @endif
            </form>
            {{ $table }}
        </div>
    </div>
@endsection
