<?php

namespace App\Exceptions\Api;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BadRequestException extends Exception
{
    public function render(Request $request): Response
    {
        return response()
            ->view('errors.external', [
                'message' => $this->getMessage(),
                'code' => 400,
            ], 400)
        ;
    }
}
