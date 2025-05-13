<?php

declare(strict_types=1);

namespace Src\Infrastructure\Outer;

final class CliOuter extends AbstractOuter
{
    public function hasError(): bool
    {
        return $this->exception ? true : false;
    }
    public function getResponse(): mixed
    {
        return $this->hasError() ? $this->exception->getMessage() : $this->data->__toArray();
    }
}