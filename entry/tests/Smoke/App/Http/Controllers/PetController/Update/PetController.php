<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Update;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetController extends TestCase
{
    use PetControllerTrait;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();

    }

    #[Test]
    public function update(): void
    {
        // GIVEN
        $request = $this->makeRequest();
        $response = $this->mockResponse();

        Http::fake([
            'https://petstore.swagger.io/v2/pet' => Http::response($response, 200),
        ]);

        // WHEN
        $response = $this
            ->put(route('pet.update', $request))
        ;

        // THEN
        $response->assertRedirect(route('pet.show', ['id' => 1]));
    }
}
