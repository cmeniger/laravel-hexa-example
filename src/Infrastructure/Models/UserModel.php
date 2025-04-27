<?php

declare(strict_types=1);

namespace App\Infrastructure\Models;

use App\Domain\User\Enum\UserStatus;
use Carbon\CarbonImmutable;
use Carbon\Traits\Timestamp;
use Database\Factories\UserModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $id
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property UserStatus $status
 * @property CarbonImmutable $created_at
 * @property CarbonImmutable $updated_at
 *
 * @ method static UserModelFactory factory(...$parameters)
 */
class UserModel extends Model
{
    use HasFactory, Timestamp;

    /**
     * The table associated with the model.
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): UserModelFactory
    {
        return UserModelFactory::new();
    }
}
