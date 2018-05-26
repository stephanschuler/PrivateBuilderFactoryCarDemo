<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder;

use StephanSchuler\PrivateBuilderFactory\Model\Engine;
use StephanSchuler\PrivateBuilderFactory\Model\Wheel;

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
        return ($this->factory)([
            'engine' => $this->engine,
            'leftFrontWheel' => $this->wheels[0],
            'rightFrontWheel' => $this->wheels[1],
            'leftRearWheel' => $this->wheels[2],
            'rightRearWheel' => $this->wheels[3],
        ]);
    }

    public function setEngine(float $volume, int $performance): CarBuilder
    {
        $this->engine = [Engine::class, $volume, $performance];
        return $this;
    }

    public function addWheel(int $size): CarBuilder
    {
        $this->wheels[] = [Wheel::class, $size];
        return $this;
    }
}