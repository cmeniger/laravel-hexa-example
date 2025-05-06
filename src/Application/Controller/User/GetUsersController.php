<?php

declare(strict_types=1);

namespace Src\Application\Controller\User;

use Src\Application\Resource\PaginatedResource;
use Src\Domain\User\Action\PaginateUsersAction;
use Src\Domain\User\Data\FilterUsersData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Src\Infrastructure\Outer\ApiOuter;

final class GetUsersController extends Controller
{
    public function __construct(private PaginateUsersAction $action)
    {
        $action->setOuter(outer: new ApiOuter(ressourceClass: PaginatedResource::class));
    }

    public function __invoke(Request $request): PaginatedResource
    {     
        return ($this->action)(data: FilterUsersData::buildFromArray(data: $request->query->all()))->getResponse();
    }
}
