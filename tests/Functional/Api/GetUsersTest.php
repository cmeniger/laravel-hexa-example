<?php

declare(strict_types=1);

namespace Tests\Functional\Api;

use Src\Domain\Core\Data\PaginatedAttributeData;
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

    it('paginated', function (string $attributes, int $page, int $perPage, int $count, int $total, int $lastPage, ?string $linkPrev, ?string $linkNext): void {
        UserModel::factory()
            ->count(100)
            ->create();
      
        $response = $this->getJson(sprintf('/api/users%s', $attributes));
               
        $response->assertStatus(200);
        
        // items
        $this->assertCount($count, $response->json('items'));
        // meta
        $this->assertEquals($page, $response->json('meta.currentPage'));
        $this->assertEquals($perPage, $response->json('meta.perPage'));
        $this->assertEquals($lastPage, $response->json('meta.lastPage'));
        $this->assertEquals($total, $response->json('meta.total'));
        // links
        $this->assertStringContainsString ('?page=1', $response->json('links.first'));
        $this->assertStringContainsString (sprintf('?page=%d', $lastPage), $response->json('links.last'));
        if ($linkPrev) {
            $this->assertStringContainsString ($linkPrev, $response->json('links.prev'));
        } else {
            $this->assertNull($response->json('links.prev'));
        }
        if ($linkNext) {
            $this->assertStringContainsString ($linkNext, $response->json('links.next'));
        } else {
            $this->assertNull($response->json('links.next'));
        }
    })->with([
        'default values'=> ['', PaginatedAttributeData::DEFAULT_PAGE, PaginatedAttributeData::DEFAULT_PER_PAGE, PaginatedAttributeData::DEFAULT_PER_PAGE, 100, 100 / PaginatedAttributeData::DEFAULT_PER_PAGE, null, '?page=2'],
        'default page'=> ['?perPage=20', PaginatedAttributeData::DEFAULT_PAGE, 20, 20, 100, 5, null, '?page=2'],
        'default perPage'=> ['?page=3', 3, PaginatedAttributeData::DEFAULT_PER_PAGE, PaginatedAttributeData::DEFAULT_PER_PAGE, 100, 100 / PaginatedAttributeData::DEFAULT_PER_PAGE, '?page=2', '?page=4'],
        'page 1 / perPage 10'=> ['?page=1&perPage=10', 1, 10, 10, 100, 10, null, '?page=2'],
        'page 10 / perPage 10'=> ['?page=10&perPage=10', 10, 10, 10, 100, 10, '?page=9', null],
        'page 5 / perPage 10'=> ['?page=5&perPage=10', 5, 10, 10, 100, 10, '?page=4', '?page=6'],
        'page 1 / perPage 100'=> ['?page=1&perPage=100', 1, 100, 100, 100, 1, null, null],
    ]);
});
