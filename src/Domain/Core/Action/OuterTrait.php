<?php 

namespace Src\Domain\Core\Action;

/**
 * @template T
 */
trait OuterTrait {
    protected ?OuterInterface $outer = null;

    /**
     * @param T $outer
     */
    public function setOuter(OuterInterface $outer): void
    {
        $this->outer = $outer;
    }

    /**
     * @return T
     */
    public function setData(mixed $data): ?OuterInterface    
    {
        $this->outer?->setData(data: $data);

        return $this->outer;
    }  

    /**
     * @return T
     */
    public function setException(\Exception $exception): ?OuterInterface
    {
        $this->outer?->setException(exception: $exception);

        return $this->outer;
    }
}