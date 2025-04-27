<?php

declare(strict_types=1);

namespace Src\Application\Controller\User\Resource;

use Src\Domain\User\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UserResource extends JsonResource
{
    /**
     * @var User
     */
    public $resource;

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getId(),
        ];
    }
}