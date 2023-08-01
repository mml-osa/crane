<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;
use Whoops\Exception\ErrorException;

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
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
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
        if ($exception instanceof TokenMismatchException) {
            return redirect(route('logout'))->withInput($request->except('password', '_token'))->withErrors(["Validation token has expired. Please try again"]);
        }

        if ($exception instanceof MethodNotAllowedHttpException){
            return redirect(route('dashboard'))->with("error", "System encountered an error. Please try again!");
        }

        if ($exception instanceof \InvalidArgumentException){
            return redirect()->back()->with('warning','Page Not Available. Please try again later');
        }

        if ($exception instanceof \Swift_TransportException){
            return redirect()->back()->with('error','Error code 553: Sender rejected');
        }

//        if ($exception instanceof \ErrorException){
//            return redirect()->back()->with("error", "System encountered an error. Please try again! $exception");
//        }
        return parent::render($request, $exception);
    }
}
