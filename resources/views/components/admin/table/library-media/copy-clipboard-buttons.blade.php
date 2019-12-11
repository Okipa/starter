<button class="btn btn-outline-primary btn-sm mx-1 clipboard-copy"
        data-library-media-id="{{ $file->id }}"
        data-type="url">
    <i class="fas fa-link fa-fw"></i>
    @lang('URL')
</button>
<button class="btn btn-outline-primary btn-sm mx-1 clipboard-copy"
        data-library-media-id="{{ $file->id }}"
        data-type="html">
    <i class="fas fa-code fa-fw"></i>
    @lang('HTML')
</button>
