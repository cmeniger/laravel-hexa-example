<?php

declare(strict_types=1);

namespace Src\Application\Controller\User;

use Src\Application\Controller\User\Resource\UserResource;
use Src\Domain\User\Action\FindUserAction;
use Src\Domain\User\Data\FindUserData;
use Src\Domain\User\Exception\UserNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class GetUserController extends Controller
{
    public function __construct(private FindUserAction $action)
    {

    }

    public function __invoke(int $id): JsonResponse|UserResource
    {
        try {
            $data = new FindUserData(id: $id);

            return new UserResource(resource: ($this->action)(data: $data));
        } catch (UserNotFoundException $exception) {
            return new JsonResponse(data: ['error' => $exception->getMessage()], status: 404);
        }
    }
}
