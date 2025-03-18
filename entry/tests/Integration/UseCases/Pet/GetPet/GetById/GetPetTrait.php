<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\GetPet\GetById;

trait GetPetTrait
{
    private function mockResponse(): array
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
