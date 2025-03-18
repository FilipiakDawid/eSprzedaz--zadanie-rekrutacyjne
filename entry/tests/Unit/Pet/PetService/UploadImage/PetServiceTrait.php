<?php

declare(strict_types=1);

namespace Tests\Unit\Pet\PetService\UploadImage;

use Mockery as m;
use Pet\ResponseFactory;
use Illuminate\Http\UploadedFile;
use UseCases\Contracts\Pet\Entities\IStatus;
use UseCases\Contracts\Requests\IFileRequest;

trait PetServiceTrait
{
    private function mockStatus(): IStatus
    {
        $mock = m::mock(IStatus::class);

        return $mock;
    }

    private function mockResponseFactory(IStatus $status): void
    {
        $m = m::mock(ResponseFactory::class);
        $m->expects('proceedRemoveResponse')->andReturn($status);
        $this->instance(ResponseFactory::class, $m);
    }

    private function mockRequestFile(): IFileRequest
    {
        $file = m::mock(UploadedFile::class);
        $mock = m::mock(IFileRequest::class);
        $mock->expects('getFileName')->andReturn('filename');
        $mock->expects('getFile')->andReturn($file);

        return $mock;
    }
}
