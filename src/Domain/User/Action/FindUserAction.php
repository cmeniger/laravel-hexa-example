<?php

declare(strict_types=1);

namespace Src\Domain\User\Action;

use Src\Domain\User\Data\FindUserData;
use Src\Domain\User\Exception\UserNotFoundException;
use Src\Domain\User\Repository\UserRepositoryInterface;
use Src\Domain\User\User;

final readonly class FindUserAction
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }

    public function __invoke(FindUserData $data): User
    {
        $user = $this->userRepository->findById(id: $data->id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        return $user;
    }
}
