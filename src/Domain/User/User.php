<?php

declare(strict_types=1);

namespace Src\Domain\User;

use Src\Domain\User\Enum\UserStatus;

final class User
{
    private int $id;
    private string $firstName;
    private string $lastName;
    private string $email;
    private UserStatus $status;

    public static function buildFromArray(array $data): self
    {
        $self = new self();
        $self->id = $data['id'];
        $self->firstName = $data['first_name'];
        $self->lastName = $data['last_name'];
        $self->email = $data['email'];
        $self->status = UserStatus::from($data['status']);
        
        return $self;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFirstName(): string
    {  
        return $this->firstName;

    }

    public function getLastName(): string
    {   
        return $this->lastName;
    }


    public function getEmail(): string
    {
        return $this->email;
    }

    public function getStatus(): UserStatus
    {
        return $this->status;
    }

    public function __toArray(): array
    {
        return [
            'id'=> $this->id,
            'first_name'=> $this->firstName,
            'last_name'=> $this->lastName,
            'email'=> $this->email,
            'status'=> $this->status->value,
        ];
    }
}
