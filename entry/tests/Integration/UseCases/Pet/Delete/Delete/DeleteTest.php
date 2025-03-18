<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\Delete\Delete;

use Tests\TestCase;
use UseCases\Pet\Delete;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use UseCases\Contracts\Pet\Entities\IStatus;

class DeleteTest extends TestCase
{
    private Delete $use_case;

    #[Test]
    public function delete_provideValidId_statusReturned(): void
    {
        // GIVEN

        // WHEN
        $result = $this->service = $this->use_case->delete(1);

        // THEN
        $this->assertInstanceOf(IStatus::class, $result);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->use_case = $this->app->make(Delete::class);
        Http::preventStrayRequests();
        Http::fake();
    }
}
