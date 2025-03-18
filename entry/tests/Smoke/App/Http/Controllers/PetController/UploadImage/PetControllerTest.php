<?php

declare(strict_types=1);

namespace Tests\Smoke\App\Http\Controllers\PetController\UploadImage;

use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;

class PetControllerTest extends TestCase
{
    #[Test]
    public function uploadImage_success_redirectToIndexRoute(): void
    {
        // GIVEN
        $upload_file = UploadedFile::fake()->image('logo.jpg');

        // WHEN
        $response = $this->post(route('pet.uploadImage', ['id' => 1]), [
            'image' => $upload_file,
        ]);

        // THEN
        $response->assertRedirectToRoute('pet.show', ['id' => 1]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        Http::preventStrayRequests();
        Http::fake();
    }
}
