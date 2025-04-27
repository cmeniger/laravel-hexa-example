<?php

declare(strict_types=1);

namespace Src\Domain\User\Data;

use Src\Domain\User\Enum\UserStatus;

final readonly class FilterUsersData
{
    public function __construct(
        public ?int $id = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?UserStatus $status = null,
    )
    {

    }
}
