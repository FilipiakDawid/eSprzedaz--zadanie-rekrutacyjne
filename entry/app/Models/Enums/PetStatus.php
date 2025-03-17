<?php

declare(strict_types=1);

namespace App\Models\Enums;

enum PetStatus: string
{
    case Available = 'available';
    case Pending = 'pending';
    case Sold = 'sold';
}
