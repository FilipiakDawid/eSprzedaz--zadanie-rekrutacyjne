<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedPetResponse;

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
        $m->expects('json')->with('category.id')->andReturn(1);
        $m->expects('json')->with('category.name')->andReturn("category name");
        $m->expects('json')->with('id')->andReturn(2);
        $m->expects('json')->with('name')->andReturn('pet name');
        $m->expects('collect')->with('photoUrls')->andReturn(new Collection(['url1', 'url2']));
        $m->expects('collect')->with('tags')->andReturn(new Collection([
            [
                'id' => 1,
                'name' => 'tag',
            ],
        ]));
        $m->expects('json')->with('status')->andReturn('sold');

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
