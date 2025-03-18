<?php

declare(strict_types=1);

namespace UseCases\Contracts\Requests;

use Illuminate\Http\UploadedFile;

interface IFileRequest
{
    public function getFile(): UploadedFile;

    public function getFileName(): string;
}