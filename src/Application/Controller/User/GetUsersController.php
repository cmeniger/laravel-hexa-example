<?php

declare(strict_types=1);

namespace Src\Application\Controller\User;

use Src\Application\Controller\User\Resource\UserResource;
use Src\Application\Resource\PaginatedResource;
use Src\Domain\User\Action\PaginateUsersAction;
use Src\Domain\User\Data\FilterUsersData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class GetUsersController extends Controller
{
    public function __construct(private PaginateUsersAction $action)
    {

    }

    public function __invoke(Request $request): PaginatedResource
    {     
        $paginatedData = ($this->action)(data: FilterUsersData::buildFromRequest(request: $request));
        
        return new PaginatedResource(
            resource: $paginatedData, 
            items: UserResource::collection(resource: $paginatedData->items),
        );
    }
}
