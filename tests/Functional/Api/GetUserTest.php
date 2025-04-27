<?php

declare(strict_types=1);

namespace Tests\Functional\Api;

use Src\Infrastructure\Models\UserModel;

describe('success cases', function (): void {
    it('found user', function (): void {
        $model = UserModel::factory()->create([
            'id' => 42,
        ]);
        
        $this->getJson(sprintf('/api/users/%d', $model->id))
            ->assertStatus(200)    
            ->assertJson([
                'id' => $model->id,
            ]);
    });
});

describe('exceptions', function (): void {
    it('not found User', function (): void {
        $this->getJson('/api/users/1')
            ->assertNotFound();
    });
});
