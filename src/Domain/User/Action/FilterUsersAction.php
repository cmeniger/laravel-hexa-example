<?php

declare(strict_types=1);

namespace Src\Domain\User\Action;

use Illuminate\Support\Collection;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\Repository\UserRepositoryInterface;
use Src\Domain\User\User;


final readonly class FilterUsersAction
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }

    /**
     * @return Collection<User>
     */
    public function __invoke(FilterUsersData $data): Collection
    {
        return $this->userRepository->findFiltered(filters: $data);
    }
}
