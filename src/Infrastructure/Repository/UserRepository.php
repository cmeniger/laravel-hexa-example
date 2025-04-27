<?php

declare(strict_types=1);

namespace Src\Infrastructure\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Src\Domain\Core\Data\PaginatedData;
use Src\Domain\User\Data\FilterUsersData;
use Src\Domain\User\Repository\UserRepositoryInterface;
use Src\Domain\User\User;
use Src\Infrastructure\Factory\UserFactory;
use Src\Infrastructure\Models\UserModel;

final class UserRepository implements UserRepositoryInterface
{
    public function __construct(private UserFactory $factory) 
    {

    }

    public function findById(int $id): ?User
    {
        $model = UserModel::find(id: $id);

        if (!$model instanceof UserModel) {
            return null;
        }

        return $this->factory->modelToEntity(model: $model);
    } 

    /**
     * @return Collection<User>
     */
    public function findFiltered(FilterUsersData $filters): Collection
    {
        $query = $this->createQueryFiltered(filters: $filters);
        
        $models = $query->get();
        $collection = new Collection();

        foreach ($models as $model) {
            $collection->add(item: $this->factory->modelToEntity(model: $model));
        }

        return $collection;
    } 

    public function findPaginated(FilterUsersData $filters): PaginatedData
    {
        $query = $this->createQueryFiltered(filters: $filters);
        
        $paginated = $query->paginate(perPage: $filters->pagination?->perPage, page: $filters->pagination?->page);
        $collection = new Collection();

        foreach ($paginated->items() as $model) {
            $collection->add(item: $this->factory->modelToEntity(model: $model));
        }

        return new PaginatedData(
            items: $collection,
            total: $paginated->total(),
            currentPage: $paginated->currentPage(),
            lastPage: $paginated->lastPage(),
            perPage: $paginated->perPage(),
            path: $paginated->path(),
        );
    }

    /**
     * @return Builder<UserModel>
     */
    private function createQueryFiltered(FilterUsersData $filters): Builder
    {
        $query = UserModel::query();
        
        if ($filters->id) {
            $query->where("id", $filters->id);
        }

        if ($filters->firstName) {
            $query->where("first_name", $filters->firstName);
        }

        if ($filters->lastName) {
            $query->where("last_name", $filters->lastName);
        }

        if ($filters->email) {
            $query->where("email", $filters->email);
        }
      
        if ($filters->status) {
            $query->where("status", $filters->status->value);
        }

        return $query;
    }
}