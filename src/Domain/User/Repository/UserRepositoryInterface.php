<?php

declare(strict_types=1);

namespace Src\Domain\User\Repository;

use Illuminate\Support\Collection;
use Src\Domain\Core\Data\PaginatedData;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
    public function findFiltered(FilterUsersData $filters): Collection;
    public function findPaginated(FilterUsersData $filters): PaginatedData;
}
