<?php

declare(strict_types=1);

namespace Src\Domain\User\Enum;

enum UserStatus: string
{
    case NEW = 'new';
    case ACTIVATED = 'activated';
    case DISABLED = 'disabled';
}