<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Support\Facades\Redirect;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        // Add exception types that should not be reported here
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $e)
    {
        if ($this->shouldntReport($e)) {
            return;
        }

        // Log the exception without stack trace
        Log::error($e->getMessage());

        parent::report($e);
    }

    public function render($request, Throwable $e)
    {
        // Log the IP address for debugging
        Log::info('Handling request from IP: ' . $request->ip());

        // Check if the application is in maintenance mode
        if (app()->isDownForMaintenance()) {
            $allowedIps = ['127.0.0.1', '::1']; // Add your actual IP addresses

            Log::info('Application in maintenance mode. Checking IP...');

            // Check if the request IP is in the allowed IPs
            if (in_array($request->ip(), $allowedIps)) {
                Log::info('IP allowed: ' . $request->ip());
                return Redirect::to($request->fullUrlWithoutQuery(['secret']));
            } else {
                Log::info('IP not allowed: ' . $request->ip());
            }
        }

        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        return response()->json([
            'code' => 401,
            'success' => false,
            'message' => $exception->getMessage(),
        ], 401);
    }

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
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
}
