<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Update;

trait PetControllerTrait
{
    private function makeRequest(): array
    {
        return [
            'id' => 1,
            'category' => [
                'id' => 1,
                'name' => 'updated Category',
            ],
            'name' => 'Updated Pet',
            'photo_urls' => [
                'updated url',
                'new url',
            ],
            'tags' => [
                [
                    'id' => 1,
                    'name' => 'updated Tag',
                ],
                [
                    'name' => 'new Tag',
                ],
            ],
            'status' => 'available',
        ];
    }

    public function mockResponse(): array
    {
        return [
            'id' => 1,
        ];
    }
}
