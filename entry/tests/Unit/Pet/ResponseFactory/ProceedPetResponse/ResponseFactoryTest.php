<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\ResponseFactory\ProceedPetResponse;

use Tests\TestCase;
use Pet\ResponseFactory;
use Pet\Entities\Category;
use App\Models\Enums\PetStatus;
use App\Exceptions\Api\ApiException;
use PHPUnit\Framework\Attributes\Test;
use App\Exceptions\Api\NotFoundException;
use UseCases\Contracts\Pet\Entities\IPet;
use App\Exceptions\Api\BadRequestException;

class ResponseFactoryTest extends TestCase
{
    use ResponseFactoryTrait;

    private ResponseFactory $factory;

    #[Test]
    public function proceedPetResponse_badRequestError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(BadRequestException::class);

        $response = $this->mockResponse(status: 400);

        // WHEN
        $this->factory->proceedPetResponse($response);

        // THEN
    }

    #[Test]
    public function proceedPetResponse_notFoundError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(NotFoundException::class);

        $response = $this->mockResponse(status: 404);

        // WHEN
        $this->factory->proceedPetResponse($response);

        // THEN
    }

    #[Test]
    public function proceedPetResponse_serverError_exceptionThrown(): void
    {
        // GIVEN
        $this->expectException(ApiException::class);

        $response = $this->mockServerErrorResponse();

        // WHEN
        $this->factory->proceedPetResponse($response);

        // THEN
    }

    #[Test]
    public function proceedPetResponse_success_petReturned(): void
    {
        // GIVEN
        $response = $this->mockSuccessResponse(status: 200);

        // WHEN
        $result = $this->factory->proceedPetResponse($response);

        // THEN
        $this->assertInstanceOf(IPet::class, $result);
        $this->assertSame(2, $result->getId());
        $this->assertSame('pet name', $result->getName());

        $this->assertCount(2, $result->getPhotoUrls());
        $this->assertContains('url1', $result->getPhotoUrls());
        $this->assertContains('url2', $result->getPhotoUrls());

        $this->assertCount(1, $result->getTags());
        $this->assertTrue($result->getTags()->contains('id', '==', 1));
        $this->assertTrue($result->getTags()->contains('name', '==', 'tag'));

        $this->assertSame(PetStatus::Sold, $result->getStatus());

        $category = $result->getCategory();
        $this->assertInstanceOf(Category::class, $category);
        $this->assertSame(1, $category->getId());
        $this->assertSame('category name', $category->getName());
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->factory = $this->app->make(ResponseFactory::class);
    }

}
