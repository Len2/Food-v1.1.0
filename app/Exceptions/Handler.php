<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Response;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

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
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
//        if ($request->expectsJson()) {
//            return response()->json(['error' => 'Unauthenticated.'], 401);
//        }


        if ( $exception instanceof TokenExpiredException) {
            return Response::json(['error' => 'Token Expired'], $exception->getStatusCode());
        } else if ($exception instanceof TokenInvalidException) {
            return Response::json(['error' => 'Token Invalid'], $exception->getStatusCode());
        } else if ($exception instanceof JWTException) {
            return Response::json(['error' => 'Error fetching Token'], $exception->getStatusCode());
        }
        return parent::render($request, $exception);
    }
}
