<div>
    <form wire:submit.prevent="submit" novalidate>
        @honeypot
        @csrf()
        <div class="form-row">
            <div class="col-md-6">
                {{ inputText()->name('first_name')
                    ->label(false)
                    ->prepend('<i class="fas fa-user"></i>')
                    ->value($first_name)
                    ->componentHtmlAttributes([
                        'required',
                        'autofocus',
                        'autocomplete' => 'given-name',
                        'wire:model.lazy' => 'first_name',
                    ]) }}
            </div>
            <div class="col-md-6">
                {{ inputText()->name('last_name')
                    ->label(false)
                    ->prepend('<i class="fas fa-user"></i>')
                    ->value($last_name)
                    ->componentHtmlAttributes([
                        'required',
                        'autocomplete' => 'family-name',
                        'wire:model.lazy' => 'last_name'
                    ]) }}
            </div>
            <div class="col-md-6">
                {{ inputEmail()->name('email')
                    ->label(false)
                    ->value($email)
                    ->componentHtmlAttributes([
                        'required',
                        'autocomplete' => 'email',
                        'wire:model.lazy' => 'email'
                    ]) }}
            </div>
            <div class="col-md-6">
                {{ inputTel()->name('phone_number')
                    ->label(false)
                    ->value($phone_number)
                    ->componentHtmlAttributes([
                        'autocomplete' => 'tel',
                        'wire:model.lazy' => 'phone_number'
                    ]) }}
            </div>
            <div class="col-md-12">
                {{ textarea()->name('message')
                    ->label(false)
                    ->value($message)
                    ->componentHtmlAttributes([
                        'required',
                        'rows' => 5,
                        'wire:model.lazy' => 'message'
                    ]) }}
            </div>
            <div class="col">
                <x-common.forms.notice/>
            </div>
            <div class="col text-right">
                {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')->label(__('Send')) }}
            </div>
        </div>
    </form>
</div>
