<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\Get;

use Mockery as m;
use App\Models\Enums\PetStatus;
use UseCases\Contracts\Requests\IPetStatus;

trait PetServiceTrait
{

    public function mockPetStatus(): IPetStatus
    {
        $m = m::mock(IPetStatus::class);
        $m->shouldReceive('getStatus')->andReturn(PetStatus::from('available'));

        return $m;
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
