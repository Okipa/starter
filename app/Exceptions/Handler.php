<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Sentry\State\Scope;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /** @inheritDoc */
    protected $dontReport = [];

    /** @inheritDoc */
    protected $dontFlash = ['password', 'password_confirmation'];

    /** @inheritDoc */
    public function report(Exception $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            /** @var \App\Models\Users\User|null $user */
            $user = auth()->user();
            if ($user) {
                app('sentry')->configureScope(fn(Scope $scope) => $scope->setUser($user->toArray()));
            }
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /** @inheritDoc */
    public function render($request, Exception $exception)
    {
        // Convert all non-http exceptions to a proper 500 http exception
        // if we don't do this exceptions are shown as a default template
        // instead of our own view in resources/views/errors/500.blade.php
        if ($this->shouldReport($exception) && ! $this->isHttpException($exception) && ! config('app.debug')) {
            $exception = new HttpException(500, __('An unexpected error has occurred.'));
        }

        return parent::render($request, $exception);
    }

    /** @inheritDoc */
    protected function invalid($request, ValidationException $exception)
    {
        if (! $request->expectsJson()) {
            toast(__('Invalid fields have been detected.'), 'error');
        }

        return parent::invalid($request, $exception);
    }
}
