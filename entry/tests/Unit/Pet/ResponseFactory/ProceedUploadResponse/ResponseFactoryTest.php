<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedUploadResponse;

use Tests\TestCase;
use Pet\ResponseFactory;
use App\Exceptions\Api\ApiException;
use PHPUnit\Framework\Attributes\Test;
use App\Exceptions\Api\NotFoundException;
use App\Exceptions\Api\BadRequestException;
use UseCases\Contracts\Pet\Entities\IUpload;
use UseCases\Contracts\Pet\Entities\IStatus;

class ResponseFactoryTest extends TestCase
{
    use ResponseFactoryTrait;

    private ResponseFactory $factory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = $this->app->make(ResponseFactory::class);
    }

    #[Test]
    public function proceedUploadResponse_badRequestError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(BadRequestException::class);

        $response = $this->mockResponse(status: 400);

        // WHEN
        $this->factory->proceedUploadResponse($response);

        // THEN
    }

    #[Test]
    public function proceedUploadResponse_notFoundError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(NotFoundException::class);

        $response = $this->mockResponse(status: 404);

        // WHEN
        $this->factory->proceedUploadResponse($response);

        // THEN
    }

    #[Test]
    public function proceedUploadResponse_serverError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(ApiException::class);

        $response = $this->mockServerErrorResponse();

        // WHEN
        $this->factory->proceedUploadResponse($response);

        // THEN
    }

    #[Test]
    public function proceedUploadResponse_success_statusReturned(): void
    {
        // GIVEN
        $response = $this->mockResponse(status: 200);

        // WHEN
        $result = $this->factory->proceedUploadResponse($response);

        // THEN
        $this->assertInstanceOf(IStatus::class, $result);
    }
}
