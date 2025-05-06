<?php

declare(strict_types=1);

namespace Src\Infrastructure\Outer;

use Src\Domain\Core\Action\OuterInterface;

abstract class AbstractOuter implements OuterInterface
{
    protected mixed $data = null;
    protected ?\Exception $exception = null;

    public function setData(mixed $data): void
    {
        $this->data = $data;
    }

    public function setException(\Exception $exception): void
    {
        $this->exception = $exception;
    }
}