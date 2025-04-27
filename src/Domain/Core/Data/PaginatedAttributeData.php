<?php

declare(strict_types=1);

namespace Src\Domain\Core\Data;

final readonly class PaginatedAttributeData
{
    public const DEFAULT_PAGE = 1;
    public const DEFAULT_PER_PAGE = 10;

    public function __construct(
        public int $page = self::DEFAULT_PAGE,
        public int $perPage = self::DEFAULT_PER_PAGE,
    )
    {
       
    }

    /**
     * @param array<string, string> $data
     */
    public static function buildFromArray(array $data): self
    {
        return new self(
            page: isset($data["page"]) ? (int) $data["page"] : self::DEFAULT_PAGE,  
            perPage: isset($data["perPage"]) ? (int) $data["perPage"] : self::DEFAULT_PER_PAGE,
        );
    }
}
