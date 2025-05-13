<?php

declare(strict_types= 1);

namespace Src\Application\Command\User;

use Illuminate\Console\Command;
use Src\Domain\User\Action\FindUserAction;
use Src\Domain\User\Data\FindUserData;
use Src\Infrastructure\Outer\CliOuter;
use Symfony\Component\Console\Helper\Table;

class GetUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:user {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get User data by this ID';

    /**
     * Execute the console command.
     */
    public function handle(FindUserAction $action): int
    {
        $id = $this->argument(key: 'id');

        if (!$id) {
            $this->error('User ID required');

            return 1;
        }

        $action->setOuter(outer: new CliOuter());

        $outer = $action(data: new FindUserData(id: (int) $id));

        if ($outer->hasError()) {
            $this->error($outer->getResponse());

            return 1;
        }

        $this->info("User found!");

        $table = new Table($this->output);
        $rows = [];

        foreach($outer->getResponse() as $index => $value) {
            $rows[] = [$index, $value];
        }

        $table->setRows($rows);
        $table->render();   

        return 0;
    }
}
