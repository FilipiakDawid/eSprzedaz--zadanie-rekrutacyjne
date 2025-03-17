<?php

declare(strict_types=1);

namespace Tests\Integration\Pet\GetById;

trait GetPetTrait
{
    public function mockResponse(): array
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
