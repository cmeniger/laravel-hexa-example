<?php

declare(strict_types=1);

namespace App\Domain\User\Enum;

enum UserStatus: string
{
    case NEW = 'new';
    case ACTIVATED = 'activated';
    case DISABLED = 'disabled';
}