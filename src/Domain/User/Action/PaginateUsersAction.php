<?php

declare(strict_types=1);

namespace Src\Domain\User\Action;

use Src\Domain\Core\Action\OuterInterface;
use Src\Domain\Core\Action\OuterTrait;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\Repository\UserRepositoryInterface;

final class PaginateUsersAction
{
    use OuterTrait;

    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }

    public function __invoke(FilterUsersData $data): ?OuterInterface
    {
        return $this->setData(data: $this->userRepository->findPaginated(filters: $data));
    }
}
