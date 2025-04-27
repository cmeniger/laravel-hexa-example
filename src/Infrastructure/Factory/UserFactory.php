<?php

declare(strict_types=1);

namespace Src\Infrastructure\Factory;

use Src\Domain\User\User;
use Src\Infrastructure\Models\UserModel;

final class UserFactory
{
    public function modelToEntity(UserModel $model): User
    {
        return User::buildFromArray(data: $model->toArray());
    }
}