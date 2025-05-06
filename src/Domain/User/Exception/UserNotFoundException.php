<?php

declare(strict_types=1);

namespace Src\Domain\User\Exception;

use Exception;

class UserNotFoundException extends Exception
{
    public function __construct()
    {
        $this->code = 404;

        parent::__construct('User does not exist.');
    }
}
