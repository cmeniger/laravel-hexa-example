<?php

declare(strict_types=1);

namespace Src\Application\Controller\User;

use Src\Application\Controller\User\Resource\UserResource;
use Src\Domain\User\Action\FindUserAction;
use Src\Domain\User\Data\FindUserData;
use Src\Infrastructure\Outer\ApiOuter;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class GetUserController extends Controller
{
    public function __construct(private FindUserAction $action)
    {      
        $action->setOuter(outer: new ApiOuter(ressourceClass: UserResource::class));
    }

    public function __invoke(int $id): JsonResponse|UserResource
    {
        return ($this->action)(data: new FindUserData(id: $id))->getResponse();
    }
}
