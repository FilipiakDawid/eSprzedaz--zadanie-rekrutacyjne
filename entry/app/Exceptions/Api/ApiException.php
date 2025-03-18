<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ApiException extends Exception
{
    protected $message = 'External api error, please try again later';

    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        $message = $this->message;
        parent::__construct($message, $code, $previous);
    }

    public function render(Request $request): Response
    {
        return response()
            ->view('errors.external', [
                'message' => $this->message,
                'code' => $this->code,
            ], 400)
        ;
    }
}
