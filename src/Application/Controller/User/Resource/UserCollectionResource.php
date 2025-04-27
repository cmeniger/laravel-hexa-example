<?php

declare(strict_types=1);

namespace Src\Application\Controller\User\Resource;

use Src\Domain\User\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class UserCollectionResource extends JsonResource
{
    /**
     * @var Collection<User>
     */
    public $resource;

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'items' => UserResource::collection($this->resource),
        ];
    }
}