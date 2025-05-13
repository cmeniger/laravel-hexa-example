<?php

declare(strict_types=1);

namespace Src\Infrastructure\Outer;

use PHPStan\PhpDocParser\Ast\ConstExpr\ConstExprFalseNode;
use Src\Application\Resource\PaginatedResource;
use Illuminate\Http\JsonResponse;

/**
 * @template T
 */
final class ApiOuter extends AbstractOuter
{
    /**
     * @param class-string<T> $ressourceClass
     */
    public function __construct(private string $ressourceClass, private ?string $paginatedItemsResourceClass = null)
    {

    }

    public function hasError(): bool
    {
        return $this->exception ? true : false;
    }

    /**
     * @return JsonResponse|T
     */
    public function getResponse(): mixed
    {
        return $this->hasError() ? 
            new JsonResponse(data: ['error' => $this->exception->getMessage()], status: $this->exception->getCode()) :
            $this->getRessource()
        ;
    }

    /**
     * @return T
     */    
    private function getRessource(): mixed
    {
        // Paginated ressource
        if (PaginatedResource::class === $this->ressourceClass) {
            return new $this->ressourceClass(
                resource: $this->data,
                items: (new $this->paginatedItemsResourceClass(null))::collection(resource: $this->data->items),
            );
        }

        return new $this->ressourceClass($this->data);
    }
}