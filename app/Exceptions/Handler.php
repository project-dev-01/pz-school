<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var string[]
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var string[]
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function (NotFoundHttpException $e, $request) {
            // if ($request->is('api/*')) {
                $response = [
                    'code' => 404,
                    'success' => false,
                    'message' => 'Object not found',
                ];
                if (!empty($errorMessages)) {
                    $response['data'] = $errorMessages;
                }
                return response()->json($response, 404);
            // }
        });
    }

    // public function render($request, Throwable $exception)
    // {
    //     // dd($exception);
    //     if($this->isHttpException($exception)) {
    //         return response()->view('errors.404');
    //     } else {
    //         return response()->view('errors.500');
    //     }
    // }
}
