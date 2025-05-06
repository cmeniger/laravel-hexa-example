<?php 

namespace Src\Domain\Core\Action;

trait OuterTrait {
    protected ?OuterInterface $outer = null;

    public function setOuter(OuterInterface $outer): void
    {
        $this->outer = $outer;
    }

    public function setData(mixed $data): ?OuterInterface
    {
        $this->outer?->setData(data: $data);

        return $this->outer;
    }

    public function setException(\Exception $exception): ?OuterInterface
    {
        $this->outer?->setException(exception: $exception);

        return $this->outer;
    }
}