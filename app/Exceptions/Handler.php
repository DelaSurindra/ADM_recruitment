<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

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
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // if ($exception->getMessage() != "" || $exception->getMessage() != null) {
        //     dd($exception, $request);
        // }
        // if ($exception instanceof \Symfony\Component\HttpFoundation\File\Exception\FileException) {
        //     // create a validator and validate to throw a new ValidationException
        //     // return Validator::make($request->all(), [
        //     //     'your_file_input' => 'required|file|size:5000',
        //     // ])->validate();
        // }
        
        if ($exception instanceof ModelNotFoundException) {
            return response()->view('error.500error', [], 404);
        }
        // if ($exception instanceof \ErrorException) {
        //     return response()->view('error.500error', [], 500);
        // }
        // else {
        //     return parent::render($request, $exception);
        // }
        return parent::render($request, $exception);

    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['code'=>401,'message'=> 'Invalid authorization token.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
