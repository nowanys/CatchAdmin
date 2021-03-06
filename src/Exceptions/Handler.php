<?php

namespace JaguarJack\CatchAdmin\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public function render($request, Exception $exception)
    {
        return $this->prepareJsonResponse($request, $exception);
    }

    /**
     * rewrite method
     *
     * @param Exception $e
     * @return array
     */
    protected function convertExceptionToArray(Exception $e)
    {
        $code = $e->getCode();
        $message = $e->getMessage();

        if ($e instanceof NotFoundHttpException) {
            $code = $e->getStatusCode();
            $message = 'Route Not Found';
        }

        return [
            'code'    => $code,
            'message' => $message
        ];
    }

    /**
     * rewrite JsonResponse
     *
     * @param \Illuminate\Http\Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function prepareJsonResponse($request, Exception $e)
    {
        return parent::prepareJsonResponse($request, $e); // TODO: Change the autogenerated stub

        // $jsonResponse->setStatusCode(HttpResponse::HTTP_OK);

        // return $jsonResponse;
    }

    protected function errorFormat()
    {

    }
}
