<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedIdResponse;

use Mockery as m;
use Illuminate\Http\Client\Response;

trait ResponseFactoryTrait
{
    private function mockResponse(int $status): Response
    {
        $m = m::mock(Response::class);
        $m->expects('status')->andReturn($status);

        return $m;
    }

    private function mockSuccessResponse(int $status, int $id): Response
    {
        $m = m::mock(Response::class);
        $m->expects('status')->andReturn($status);
        $m->expects('json')->with('id')->andReturn($id);

        return $m;
    }

    private function mockServerErrorResponse(): Response
    {
        $m = m::mock(Response::class);
        $m->expects('status')->andReturn(500);
        $m->expects('getStatusCode')->andReturn(500);

        return $m;
    }
}
