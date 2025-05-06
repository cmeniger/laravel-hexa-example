<?php

declare(strict_types=1);

namespace Src\Domain\User\Action;

use Src\Domain\Core\Action\OuterInterface;
use Src\Domain\Core\Action\OuterTrait;
use Src\Domain\User\Data\FindUserData;
use Src\Domain\User\Exception\UserNotFoundException;
use Src\Domain\User\Repository\UserRepositoryInterface;

final class FindUserAction
{
    use OuterTrait;

    public function __construct(private UserRepositoryInterface $userRepository)
    {

    }

    public function __invoke(FindUserData $data): ?OuterInterface
    {
        $user = $this->userRepository->findById(id: $data->id);

        if (!$user) {
            return $this->setException(exception: new UserNotFoundException());
        }
        
        return $this->setData(data: $user);
    }
}
