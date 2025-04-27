<?php

declare(strict_types=1);

namespace Src\Domain\Core\Data;

use Illuminate\Support\Collection;
use stdClass;

final readonly class PaginatedData
{
    public stdClass $links;

    public function __construct(
        public Collection $items,
        public int $total,
        public int $currentPage,
        public int $lastPage,
        public int $perPage,
        public ?string $path = null,
    )
    {
        $this->initiateLinks();
    }

    private function initiateLinks(): void
    {
        $this->links = new stdClass();
        $this->links->first = null;
        $this->links->last = null;
        $this->links->prev = null;
        $this->links->next = null;
        
        if ($this->path) {
            $this->links->first = sprintf("$this->path?page=%d", 1);
            $this->links->last = sprintf("$this->path?page=%d", $this->lastPage);
            $this->links->prev = $this->currentPage > 1 ? sprintf("$this->path?page=%d", $this->currentPage - 1) : null;
            $this->links->next = $this->currentPage < $this->lastPage ? sprintf("$this->path?page=%d", $this->currentPage + 1) : null;
        }
    }
}
