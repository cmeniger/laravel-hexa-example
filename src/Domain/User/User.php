<?php

declare(strict_types=1);

namespace Src\Domain\User;

use phpDocumentor\Reflection\Types\Self_;

final class User
{
    private int $id;

    public static function buildFromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['id'];
        
        return $self;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
