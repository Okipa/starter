<div class="d-flex">
    <x-form::button.link class="btn-secondary me-2" :href="$adminPanelUrl">
        <i class="fas fa-undo fa-fw"></i>
        {{ __('Back') }}
    </x-form::button.link>
    <x-form::button.submit>
        <i class="fas fa-save fa-fw"></i>
        {{ __('Save') }}
    </x-form::button.submit>
</div>
