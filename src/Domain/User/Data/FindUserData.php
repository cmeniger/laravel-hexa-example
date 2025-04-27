<?php

declare(strict_types=1);

namespace Src\Domain\User\Data;

final readonly class FindUserData
{
    public function __construct(
        public int $id)
    {

    }
}