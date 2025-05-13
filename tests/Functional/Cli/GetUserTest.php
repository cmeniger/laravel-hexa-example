<?php

declare(strict_types=1);

namespace Tests\Functional\Cli;

use RuntimeException;
use Src\Infrastructure\Models\UserModel;

describe('success cases', function (): void {
    it('found user', function (): void {
        $model = UserModel::factory()->create([
            'id' => 42,
        ]);
        
        $this->artisan('app:user 42')
            ->expectsOutput('User found!')
            ->assertExitCode(0);
    });
});

describe('exceptions', function (): void {
    it('ID required', function (): void {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Not enough arguments (missing: "id").');
        
        $this->artisan('app:user');
    });
    it('not found User', function (): void {
        $this->artisan('app:user 42')
            ->expectsOutput('User does not exist.')
            ->assertExitCode(1);
    });
});
