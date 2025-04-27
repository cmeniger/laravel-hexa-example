<?php

declare(strict_types=1);

namespace Src\Domain\User\Action;

use Src\Domain\Core\Data\PaginatedData;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\Repository\UserRepositoryInterface;


final readonly class PaginateUsersAction
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }

    public function __invoke(FilterUsersData $data): PaginatedData
    {
        return $this->userRepository->findPaginated(filters: $data);
    }
}
