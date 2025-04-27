<?php

declare(strict_types=1);

namespace Src\Domain\Core\Data;

use Illuminate\Http\Request;

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

    public static function buildFromRequest(Request $request): self
    {
        return new self(
            page: (int) $request->query("page",(string) self::DEFAULT_PAGE),
            perPage: (int) $request->query("perPage",(string) self::DEFAULT_PER_PAGE),
        );
    }
}
