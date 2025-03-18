<?php

namespace App\Http\Requests;

use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Http\FormRequest;
use UseCases\Contracts\Requests\IFileRequest;

class UploadImageRequest extends FormRequest implements IFileRequest
{
    public function rules(): array
    {
        return [
            'image' => ['required', 'mimes:jpeg,jpg,png', 'max:1024'],
        ];
    }

    public function getFile(): UploadedFile
    {
        return $this->file('image');
    }

    public function getFileName(): string
    {
        return $this->file('image')->getFilename();
    }
}
