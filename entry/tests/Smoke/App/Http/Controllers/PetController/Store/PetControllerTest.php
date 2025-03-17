<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Store;

use Tests\TestCase;
use App\Models\Enums\PetStatus;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();

    }

    #[Test]
    public function store_provideValidData(): void
    {
        // GIVEN
        $input_data = [
            'name' => 'Pet',
            'photo_urls' => ['url1', 'url2'],
            'status' => PetStatus::Available,
            'category' => [],
            'tags' => []
        ];
        $response = [
            'id' => 1,
        ];

        Http::fake(['*' => Http::response($response, 200)]);

        // WHEN
        $response = $this
            ->post(route('pet.store', $input_data))
        ;

        // THEN
        $response->assertRedirect(route('pet.show', ['id' => 1]));
    }
}
