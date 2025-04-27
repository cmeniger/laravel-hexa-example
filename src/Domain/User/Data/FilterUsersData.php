<?php

declare(strict_types=1);

namespace Src\Domain\User\Data;

use Src\Domain\Core\Data\PaginatedAttributeData;
use Src\Domain\User\Enum\UserStatus;

final readonly class FilterUsersData
{
    public function __construct(
        public ?int $id = null,
        public ?string $firstName = null,
        public ?string $lastName = null,
        public ?string $email = null,
        public ?UserStatus $status = null,
        public ?PaginatedAttributeData $pagination = null,
    )
    {

    }

    /**
     * @param array<string, string> $data
     */
    public static function buildFromArray(array $data): self
    {
        return new self(
            id: isset($data["id"]) ? (int) $data["id"] : null,
            firstName: $data["firstName"] ?? null,
            lastName: $data["lastName"] ?? null,
            email: $data["email"] ?? null,
            status: UserStatus::tryFrom($data["status"] ?? ''),
            pagination: PaginatedAttributeData::buildFromArray(data: $data),
        );
    }
}
