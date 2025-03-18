<?php

declare(strict_types=1);

namespace Tests\Integration\UseCases\Pet\Update\UploadImage;

use Mockery as m;
use Illuminate\Http\UploadedFile;
use UseCases\Contracts\Requests\IFileRequest;

trait UploadTrait
{
    private function mockRequestFile(): IFileRequest
    {
        $file = m::mock(UploadedFile::class);
        $mock = m::mock(IFileRequest::class);
        $mock->expects('getFileName')->andReturn('filename');
        $mock->expects('getFile')->andReturn($file);

        return $mock;
    }
}
