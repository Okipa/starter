<div class="d-flex">
    <a class="btn btn-secondary mr-2" href="{{ $adminPanelUrl }}" role="button">
        <i class="fas fa-undo fa-fw"></i> @lang('Back')
    </a>
    <button class="btn btn-primary" type="submit">
        @if($brick)
            <i class="fas fa-save fa-fw"></i> @lang('Update')
        @else
            <i class="fas fa-plus-circle fa-fw"></i> @lang('Create')
        @endif
    </button>
</div>
