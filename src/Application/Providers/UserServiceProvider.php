<?php
 
namespace Src\Application\Providers;
 
use Illuminate\Support\ServiceProvider;
use Src\Application\Command\User\GetUserCommand;
use Src\Domain\User\Repository\UserRepositoryInterface;
use Src\Infrastructure\Repository\UserRepository;
 
class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Repositories
         */
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
 
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        /**
         * Commands
         */
        $this->commands([
            GetUserCommand::class,
        ]);
    }
}