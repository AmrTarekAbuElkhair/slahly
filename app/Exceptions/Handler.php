<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        $lang=($request->hasHeader('lang')) ? $request->header('lang') : 'en';
        if ($request->segment(1) == 'api') {
            if ($exception instanceof AuthenticationException) {
                return response(res_msg($lang, failed(), 401, 'Session_Expired'));
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response(res_msg($lang, failed(), 401,'method'));
            }
            if ($exception instanceof NotFoundHttpException) {
                return response(res_msg($lang, failed(), 401, 'url'));
            }

        }
        return parent::render($request,$exception);
    }
}
