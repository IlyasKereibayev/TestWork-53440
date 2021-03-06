<?php

namespace App\Exceptions;

use App\Traits\RestExceptionHandlerTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    use RestExceptionHandlerTrait;
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
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if(!$this->isApiCall($request)) {
            $retval = parent::render($request, $e);
        } else {
            $retval = $this->getJsonResponseForException($request, $e);
        }

        return $retval;
    }

    protected function isApiCall(Request $request)
    {
        return strpos($request->getUri(), '/api/') !== false;
    }
}
