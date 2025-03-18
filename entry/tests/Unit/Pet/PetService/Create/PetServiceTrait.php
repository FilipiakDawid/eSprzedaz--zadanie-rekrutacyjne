<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Create;

use Mockery as m;
use Pet\ResponseFactory;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use UseCases\Contracts\Requests\IPetRequest;

trait PetServiceTrait
{
    public function mockResponseFactory(int $id): void
    {
        $m = m::mock(ResponseFactory::class);
        $m->expects('proceedIdResponse')->andReturn($id);
        $this->instance(ResponseFactory::class, $m);
    }

    public function mockRequest(): IPetRequest
    {
        $tags = $this->app->make(Collection::class);
        $tags->push(['name' => 'new Tag']);
        $category = [
            'name' => 'new Category',
        ];

        $photo_urls = ['url'];

        $request = m::mock(IPetRequest::class);
        $request->expects('getId')->andReturn(1);
        $request->expects('getName')->andReturn('New Pet');
        $request->expects('getStatus')->andReturn(PetStatus::Available);
        $request->expects('getTags')->andReturn($tags);
        $request->expects('getCategory')->andReturn($category);
        $request->expects('getPhotoUrls')->andReturn($photo_urls);

        return $request;
    }

    public function mockResponse(): array
    {
        return [
            'id' => 1,
            'category' => [
                'id' => 1,
                'name' => 'new Category',
            ],
            'name' => 'New Pet',
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
        ];
    }
}
