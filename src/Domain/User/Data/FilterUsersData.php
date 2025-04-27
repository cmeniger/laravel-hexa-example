<?php

declare(strict_types=1);

namespace Src\Domain\User\Data;

use Src\Domain\Core\Data\PaginatedAttributeData;
use Src\Domain\User\Enum\UserStatus;
use Illuminate\Http\Request;

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

    public static function buildFromRequest(Request $request): self
    {
        return new self(
            id: (int) $request->query('id'),
            firstName: $request->query('firstName'),
            lastName: $request->query('lastName'),
            email: $request->query('email'),
            status: UserStatus::tryFrom((string) $request->query('status')),
            pagination: PaginatedAttributeData::buildFromRequest(request: $request),
        );
    }
}
