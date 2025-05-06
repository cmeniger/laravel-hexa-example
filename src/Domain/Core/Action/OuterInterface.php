<?php

declare(strict_types=1);

namespace Src\Domain\Core\Action;

interface OuterInterface
{
    public function setData(mixed $data): void;
    public function setException(\Exception $exception): void;
    public function getResponse(): mixed;
}