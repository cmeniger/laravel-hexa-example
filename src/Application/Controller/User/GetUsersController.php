<?php

declare(strict_types=1);

namespace Src\Application\Controller\User;

use Src\Application\Controller\User\Resource\UserResource;
use Src\Application\Resource\PaginatedResource;
use Src\Domain\Core\Data\PaginatedAttributeData;
use Src\Domain\User\Action\PaginateUsersAction;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\Enum\UserStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class GetUsersController extends Controller
{
    public function __construct(private PaginateUsersAction $action)
    {

    }

    public function __invoke(Request $request): JsonResponse|PaginatedResource
    {     
        $data = new FilterUsersData(
            id: (int) $request->query('id'),
            firstName: $request->query('firstName'),
            lastName: $request->query('lastName'),
            email: $request->query('email'),
            status: UserStatus::tryFrom((string) $request->query('status')),
            pagination: PaginatedAttributeData::buildFromRequest(request: $request),
        );

        $paginatedData = ($this->action)(data: $data);
        
        return new PaginatedResource(
            resource: $paginatedData, 
            items: UserResource::collection(resource: $paginatedData->items),
        );
    }
}
