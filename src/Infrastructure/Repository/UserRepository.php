<?php

declare(strict_types=1);

namespace Src\Infrastructure\Repository;

use Src\Domain\User\Repository\UserRepositoryInterface;
use Src\Domain\User\User;
use Src\Infrastructure\Factory\UserFactory;
use Src\Infrastructure\Models\UserModel;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(private UserFactory $factory) 
    {

    }

    public function findById(int $id): ?User
    {
        $model = UserModel::find(id: $id);

        if (!$model instanceof UserModel) {
            return null;
        }

        return $this->factory->modelToEntity(model: $model);
    } 
}