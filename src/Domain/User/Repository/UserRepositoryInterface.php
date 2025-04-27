<?php

declare(strict_types=1);

namespace Src\Domain\User\Repository;

use Src\Domain\User\User;

interface UserRepositoryInterface
{
    public function findById(int $id): ?User;
}