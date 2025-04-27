<?php

declare(strict_types=1);

namespace Src\Application\Resource;

use Src\Domain\Core\Data\PaginatedData;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Request;

final class PaginatedResource extends JsonResource
{
    public function __construct($resource, AnonymousResourceCollection $items)
    {
        $this->items = $items;

        parent::__construct(resource: $resource);
    }

    /**
     * @var PaginatedData
     */
    public $resource;

    /**
     * @var AnonymousResourceCollection
     */
    public $items = null;

    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'items' => $this->items,
            'meta' => [
                'current_page' => $this->resource->currentPage,
                'last_page'=> $this->resource->lastPage,
                'per_page'=> $this->resource->perPage,
                'total' => $this->resource->total,
            ],
            'links' => [
                'first' => $this->resource->links->first,
                'last' => $this->resource->links->last,
                'prev' => $this->resource->links->prev,
                'next' => $this->resource->links->next,
            ],
        ];
    }
}