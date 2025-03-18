<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\Delete;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetControllerTest extends TestCase
{
    #[Test]
    public function delete_success_redirectToIndexRoute(): void
    {
        // GIVEN

        // WHEN
        $response = $this
            ->delete(route('pet.delete', ['id' => 1]))
        ;

        // THEN
        $response->assertRedirectToRoute('index');
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Http::fake();
    }
}
