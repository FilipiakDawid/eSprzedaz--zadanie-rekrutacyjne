<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\FindById;

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
    public function findById(): void
    {
        // GIVEN
        $pet = $this->mockPetResponse();

        Http::fake(['*' => Http::response($pet, 200)]);

        // WHEN
        $response = $this
            ->get(route('pet.show', ['id' => 1]))
        ;

        // THEN
        $response->assertOk();
        $response->assertViewIs('pet.show');
    }
}
