<div class="pt-1 pb-3">
    <span class="h6">
        @lang('components.notice.title')
    </span>
    <span class="pl-3">
        <span class="form-group">
            <span class="text-danger">*</span>
            <span class="small">
                @lang('components.notice.required')
            </span>
        </span>
    </span>
    @if(count(LaravelLocalization::getSupportedLocales()) > 1)
        <span class="pl-3">
            <span class="form-group">
                <span class="text-success">*</span>
                <span class="small">
                    @lang('components.notice.multilingual')
                </span>
            </span>
        </span>
    @endif
</div>
