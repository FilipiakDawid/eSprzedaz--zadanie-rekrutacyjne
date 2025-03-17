<?php

declare(strict_types=1);

namespace UseCases\Contracts\Requests;

interface IUpdatePetRequest extends IPetRequest
{
    public function getPetId(): int;
}