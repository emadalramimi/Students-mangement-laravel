<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

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
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            // Optional: Log authorization exceptions
            if ($e instanceof AuthorizationException) {
                Log::warning('Unauthorized access attempt', [
                    'user' => auth()->user() ? auth()->user()->id : 'guest',
                    'message' => $e->getMessage()
                ]);
            }
        });

        $this->renderable(function (AuthorizationException $e) {
            // Redirect to custom 403 page
            return response()->view('errors.403', [], 403);
        });
    }
}
