<div>
    <form wire:submit.prevent="submit" novalidate>
{{--        <x-honeypot/>--}}
        <div class="form-row">
            <div class="col-md-6">
                {{ inputText()->name('first_name')
                    ->label(null)
                    ->prepend('<i class="fas fa-user"></i>')
                    ->value($first_name)
                    ->wire('debounce.500ms')
                    ->componentHtmlAttributes(['required','autofocus', 'autocomplete' => 'given-name']) }}
            </div>
            <div class="col-md-6">
                {{ inputText()->name('last_name')
                    ->label(null)
                    ->prepend('<i class="fas fa-user"></i>')
                    ->value($last_name)
                    ->wire('debounce.500ms')
                    ->componentHtmlAttributes(['required', 'autocomplete' => 'family-name']) }}
            </div>
            <div class="col-md-6">
                {{ inputEmail()->name('email')
                    ->label(null)
                    ->value($email)
                    ->wire('debounce.500ms')
                    ->componentHtmlAttributes(['required', 'autocomplete' => 'email']) }}
            </div>
            <div class="col-md-6">
                {{ inputTel()->name('phone_number')
                    ->label(null)
                    ->value($phone_number)
                    ->wire('debounce.500ms')
                    ->componentHtmlAttributes(['autocomplete' => 'tel']) }}
            </div>
            <div class="col-md-12">
                {{ textarea()->name('message')
                    ->label(null)
                    ->value($message)
                    ->wire('debounce.500ms')
                    ->componentHtmlAttributes(['required', 'rows' => 5]) }}
            </div>
            <div class="col-md-8">
                @include('components.common.form.notice')
            </div>
            <div class="col-md-4 text-right">
                {{ submit()->prepend('<i class="fas fa-paper-plane fa-fw"></i>')->label(__('Send')) }}
            </div>
        </div>
    </form>
</div>
