<?php

declare(strict_types=1);

namespace Tests\Integration\Pet\Update\Update;

use Mockery as m;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use UseCases\Contracts\Requests\IUpdatePetRequest;

trait UpdateTrait
{
    public function mockRequest(): IUpdatePetRequest
    {
        $tags = $this->app->make(Collection::class);
        $tags->push(['name' => 'new Tag']);
        $tags->push(['id' => 1, 'name' => 'updated Tag']);
        $category = [
            'id' => 1,
            'name' => 'updated Category',
        ];

        $photo_urls = ['updated url', 'new url'];

        $request = m::mock(IUpdatePetRequest::class);
        $request->expects('getId')->andReturn(1);
        $request->expects('getName')->andReturn('Updated Pet');
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
                'name' => 'updated Category',
            ],
            'name' => 'Updated Pet',
            'photoUrls' => [
                'updated url',
                'new url',
            ],
            'tags' => [
                [
                    'id' => 1,
                    'name' => 'updated Tag',
                ],
                [
                    'id' => 2,
                    'name' => 'new Tag',
                ],
            ],
            'status' => 'available',
        ];
    }
}
