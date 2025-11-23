<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Symfony\Component\HttpFoundation\Response;

class Handler extends ExceptionHandler
{
    protected $levels = [
        //
    ];

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->renderable(function (\Symfony\Component\HttpKernel\Exception\PostTooLargeException $e, $request) {
            return redirect()->back()
                ->with('error', 'Ukuran file terlalu besar! Maksimal 2MB.')
                ->withInput();
        });
    }
}
