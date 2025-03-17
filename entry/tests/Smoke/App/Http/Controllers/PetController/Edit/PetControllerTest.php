<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Edit;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetControllerTest extends TestCase
{
    use PetControllerTrait;

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
    }

    #[Test]
    public function create(): void
    {
        // GIVEN
        $pet = $this->mockPetResponse();

        Http::fake(['*' => Http::response($pet, 200)]);

        // WHEN
        $response = $this
            ->get(route('pet.edit', ['id' => 1]))
        ;

        // THEN
        $response->assertOk();
        $response->assertViewIs('pet.edit');
    }
}
