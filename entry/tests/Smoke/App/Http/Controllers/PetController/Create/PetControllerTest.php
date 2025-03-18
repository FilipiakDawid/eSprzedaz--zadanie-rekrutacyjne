<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Create;

use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class PetControllerTest extends TestCase
{
    #[Test]
    public function create(): void
    {
        // GIVEN

        // WHEN
        $response = $this
            ->get(route('pet.create'))
        ;

        // THEN
        $response->assertOk();
        $response->assertViewIs('pet.create');
    }
}
