<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Edit;

trait PetControllerTrait
{
    public function mockPetResponse(): array
    {
        return [
            'id' => 1,
            'category' => [
                'id' => 1,
                'name' => 'cate',
            ],
            'name' => 'cat',
            'photoUrls' => [],
            'tags' => [],
            'status' => "sold",
        ];
    }
}
