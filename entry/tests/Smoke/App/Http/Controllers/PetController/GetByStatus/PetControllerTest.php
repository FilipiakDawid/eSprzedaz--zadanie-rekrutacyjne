<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\GetByStatus;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetControllerTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Http::fake();
    }

    #[Test]
    public function getByStatus(): void
    {
        // GIVEN

        // WHEN
        $response = $this
            ->get(route('index'))
        ;

        // THEN
        $response->assertOk();
        $response->assertViewIs('pet.index');
    }
}
