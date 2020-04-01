<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\ValidationException;
use Sentry\State\Scope;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = ['password', 'password_confirmation'];

    /**
     * @param \Exception $exception
     *
     * @throws \Exception
     */
    public function report(Exception $exception): void
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

    /**
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function render($request, Exception $exception): Response
    {
        // Convert all non-http exceptions to a proper 500 http exception
        // if we don't do this exceptions are shown as a default template
        // instead of our own view in resources/views/errors/500.blade.php
        if (! $request->expectsJson()
            && $this->shouldReport($exception)
            && ! $this->isHttpException($exception)
            && ! config('app.debug')) {
            $exception = new HttpException(500, __('An unexpected error has occurred.'));
        }

        return parent::render($request, $exception);
    }

    protected function invalid($request, ValidationException $exception): RedirectResponse
    {
        if (! $request->expectsJson()) {
            toast(__('Invalid fields have been detected.'), 'error');
        }

        return parent::invalid($request, $exception);
    }
}
