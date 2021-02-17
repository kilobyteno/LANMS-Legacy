<?php

namespace LANMS\Exceptions;

use Throwable;
use Igaster\LaravelTheme\Facades\Theme;
use Illuminate\Session\TokenMismatchException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    private $sentryID;

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        if (app()->bound('sentry') && $this->shouldReport($exception)) {
            app('sentry')->captureException($exception);
        }
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        Theme::set('vobilet');
        if ($exception instanceof NotFoundHttpException) {
            return view('errors.404');
        }

        if ($exception instanceof ThrottlingException) {
            return view('errors.429')->with('message', $exception->getMessage());
        }

        if ($exception instanceof TokenMismatchException) {
            //Redirect to login form if session expires
            return redirect()->back()
                        ->with('messagetype', 'danger')
                        ->with('message', 'Validation Token has expired. Please try again!');
        }

        // Convert all non-http exceptions to a proper 500 http exception
        // if we don't do this exceptions are shown as a default template
        // instead of our own view in resources/views/errors/500.blade.php
        if (!config('app.debug') && $this->shouldReport($exception) && !$this->isHttpException($exception)) {
            $exception = new HttpException(500, 'Whoops!');
        }

        return parent::render($request, $exception);
    }
}