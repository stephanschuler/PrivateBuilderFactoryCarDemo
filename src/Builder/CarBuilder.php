<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder;

class CarBuilder implements Builder
{
    private $factory;

    private $engine;

    private $wheels = [];

    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke()
    {
        return ($this->factory)($this->engine, $this->wheels);
    }

    public function setEngine(float $volume, int $performance): CarBuilder
    {
        $this->engine = [$volume, $performance];
        return $this;
    }

    public function addWheel(int $size): CarBuilder
    {
        $this->wheels[] = [$size];
        return $this;
    }
}