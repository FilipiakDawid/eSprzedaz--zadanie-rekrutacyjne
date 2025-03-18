<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\Update\UploadImage;

use Tests\TestCase;
use UseCases\Pet\Update;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use UseCases\Contracts\Pet\Entities\IStatus;

class UploadTest extends TestCase
{
    use UploadTrait;

    private Update $use_case;

    #[Test]
    public function uploadImage_provideValidId_statusReturned(): void
    {
        // GIVEN
        $request = $this->mockRequestFile();

        // WHEN
        $result = $this->service = $this->use_case->uploadImage($request, 1);

        // THEN
        $this->assertInstanceOf(IStatus::class, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(Update::class);
        Http::preventStrayRequests();
        Http::fake();
    }
}
