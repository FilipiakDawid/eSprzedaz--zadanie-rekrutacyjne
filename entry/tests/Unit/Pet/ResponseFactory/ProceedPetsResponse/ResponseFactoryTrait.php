<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedPetsResponse;

use Mockery as m;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Response;

trait ResponseFactoryTrait
{
    private function mockResponse(int $status): Response
    {
        $m = m::mock(Response::class);
        $m->expects('status')->andReturn($status);

        return $m;
    }

    private function mockSuccessResponse(int $status): Response
    {
        $m = m::mock(Response::class);
        $m->expects('status')->andReturn($status);
        $m->expects('collect')->andReturn(new Collection($this->mockResponseBody()));

        return $m;
    }

    private function mockResponseBody(): array
    {
        return [
            [
                'id' => 1,
                'category' => [
                    'id' => 1,
                    'name' => 'string',
                ],
                'name' => 'doggie',
                'photoUrls' => [
                    'url1',
                    'url2',
                ],
                'tags' => [
                    [
                        'id' => 1,
                        'name' => 'tag',
                    ],
                ],
                'status' => 'available',
            ],
            [
                'id' => 1,
                'category' => [
                    'id' => 1,
                    'name' => 'string',
                ],
                'name' => 'doggie',
                'photoUrls' => [
                    'url1',
                    'url2',
                ],
                'tags' => [],
                'status' => 'available',
            ],
        ];
    }

    private function mockServerErrorResponse(): Response
    {
        $m = m::mock(Response::class);
        $m->expects('status')->andReturn(500);
        $m->expects('getStatusCode')->andReturn(500);

        return $m;
    }
}
