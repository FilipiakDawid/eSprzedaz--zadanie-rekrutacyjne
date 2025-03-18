<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Get;

use Mockery as m;
use Pet\ResponseFactory;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Collection;
use UseCases\Contracts\Requests\IPetStatus;

trait PetServiceTrait
{

    public function mockPetStatus(): IPetStatus
    {
        $m = m::mock(IPetStatus::class);
        $m->expects('getStatus')->andReturn([PetStatus::Available->value]);

        return $m;
    }

    public function mockResponseFactory(array $response): void
    {
        $m = m::mock(ResponseFactory::class);
        $collection = new Collection($response);
        $m->expects('proceedPetsResponse')->andReturn($collection);
        $this->instance(ResponseFactory::class, $m);
    }

    private function mockResponse(): array
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

}
