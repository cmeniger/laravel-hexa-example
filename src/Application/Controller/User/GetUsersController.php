<?php

declare(strict_types=1);

namespace Src\Application\Controller\User;

use Src\Application\Controller\User\Resource\UserCollectionResource;
use Src\Domain\User\Action\FilterUsersAction;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\Enum\UserStatus;
use Src\Domain\User\Exception\UserNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class GetUsersController extends Controller
{
    public function __construct(private FilterUsersAction $action)
    {

    }

    public function __invoke(Request $request): JsonResponse|UserCollectionResource

    {
        try {
            $data = new FilterUsersData(
                id: (int) $request->query('id'),
                firstName: $request->query('firstName'),
                lastName: $request->query('lastName'),
                email: $request->query('email'),
                status: UserStatus::tryFrom((string) $request->query('status')),
            );

            return new UserCollectionResource(resource: ($this->action)(data: $data));
        } catch (UserNotFoundException $exception) {
            return new JsonResponse(data: ['error' => $exception->getMessage()], status: 404);
        }
    }
}
