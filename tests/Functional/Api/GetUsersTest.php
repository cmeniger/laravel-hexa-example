<?php

declare(strict_types=1);

namespace Tests\Functional\Api;

use Src\Domain\User\Enum\UserStatus;
use Src\Infrastructure\Models\UserModel;

describe('success cases', function (): void {
    it('no users', function (): void {
        $this->getJson('/api/users')
            ->assertStatus(200)    
            ->assertJson([]);
    });

    it('users', function (): void {
        UserModel::factory()
            ->count(5)
            ->create();
      
        $response = $this->getJson('/api/users');
        
        $response->assertStatus(200);
        $this->assertCount(5, $response->json('items'));
    });

    it('filtered', function (string $attributes, int $count): void {
        UserModel::factory()
            ->count(5)
            ->sequence(
                ['id' => 1, 'first_name' => 'John', 'last_name'=> 'Doe', 'email'=> 'john.doe@domain.com', 'status' => UserStatus::ACTIVATED],
                ['id' => 2, 'first_name' => 'Jane', 'last_name'=> 'Doe', 'email'=> 'jane.doe@domain.com', 'status' => UserStatus::ACTIVATED],
                ['id' => 3, 'first_name' => 'Laris', 'last_name'=> 'Clark', 'email'=> 'larisc@domain.com', 'status' => UserStatus::ACTIVATED],
                ['id' => 4, 'first_name' => 'Paul', 'last_name'=> 'Bulton', 'email'=> 'paul.bulton@domain.com', 'status' => UserStatus::DISABLED],
                ['id' => 5, 'first_name' => 'Harry', 'last_name'=> 'Colton', 'email'=> 'harry.colton@domain.com', 'status' => UserStatus::NEW],
            )
            ->create();
      
        $response = $this->getJson(sprintf('/api/users%s', $attributes));
        
        $response->assertStatus(200);
        $this->assertCount($count, $response->json('items'));
    })->with([
        'by id'=> ['?id=1', 1],
        'by firstName'=> ['?firstName=John', 1],
        'by lastName'=> ['?lastName=Doe', 2],
        'by lastName and firstName'=> ['?firstName=John&lastName=Doe', 1],
        'by lastName and firstName not found'=> ['?firstName=John&lastName=Bulton', 0],
        'by email'=> ['?email=harry.colton@domain.com', 1],
        'by status'=> ['?status='.UserStatus::ACTIVATED->value, 3],
        'by unknown firstName'=> ['?firstName=Jim', 0],
        'by unknown filter'=> ['?test=Jim', 5],
    ]);
});
