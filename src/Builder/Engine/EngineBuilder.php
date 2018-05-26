<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder\Engine;

use StephanSchuler\PrivateBuilderFactory\Builder\Builder;
use StephanSchuler\PrivateBuilderFactory\Model\Car;
use StephanSchuler\PrivateBuilderFactory\Model\Engine;

class EngineBuilder implements Builder
{
    private $factory;

    protected $car;

    protected $volume;

    protected $performance;

    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke()
    {
        $addDataToObject = function (Engine $wheel) {
            $state = new class
            {
                public $car;
                public $size;
            };
            $state->car = $this->car;
            $state->volume = $this->volume;
            return $state;
        };
        return call_user_func($this->factory, $addDataToObject);
    }

    public function setCar(Car $car): EngineBuilder
    {
        $this->car = $car;
        return $this;
    }

    public function setVolume(float $volume): EngineBuilder
    {
        $this->volume = $volume;
        return $this;
    }

    public function setPerformance(int $performance): EngineBuilder
    {
        $this->performance = $performance;
        return $this;
    }
}