<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register()
    {
        $this->renderable(function (Throwable $exception, $request) {
            return $this->handleApiException($exception, $request);
        });
    }

    /**
     * Handle API exceptions globally.
     */
    private function handleApiException(Throwable $exception, $request): JsonResponse
    {
        if ($exception instanceof ModelNotFoundException) {
            return response()->json([
                'error' => 'Resource not found'
            ], 404);
        }

        if ($exception instanceof AuthorizationException) {
            return response()->json([
                'error' => 'Unauthorized action'
            ], 403);
        }


        if ($exception instanceof ValidationException) {
            return response()->json([
                'error' => 'Validation error',
                'messages' => $exception->errors()
            ], 422);
        }

        if ($exception instanceof NotFoundHttpException) {
            return response()->json([
                'error' => 'API route not found'
            ], 404);
        }
        if ($exception instanceof AccessDeniedHttpException
        ) {
            return response()->json([
                'success' => false,
                'message' => 'You do not have permission to perform this action'
            ], 403);
        }
        return response()->json([
            'error' => 'An unexpected error occurred',
            'message' => $exception->getMessage()
        ], 500);
    }
}
