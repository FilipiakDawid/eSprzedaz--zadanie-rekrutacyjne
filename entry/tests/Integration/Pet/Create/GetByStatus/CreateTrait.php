<?php

declare(strict_types=1);

namespace Tests\Integration\Pet\Create\GetByStatus;

use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use UseCases\Contracts\Requests\IPetRequest;
use Mockery as m;

trait CreateTrait
{
    public function mockRequest(): IPetRequest
    {
        $tags = $this->app->make(Collection::class);
        $tags->push(['name' => 'new Tag']);
        $category = [
            'name' => 'new Category',
        ];

        $photo_urls = ['url'];

        $request = m::mock(IPetRequest::class);
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
        ];
    }
}
