<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder;

use StephanSchuler\PrivateBuilderFactory\Model\Car;
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
        $addDataToObject = function (Car $car) {
            $state = new class
            {
                public $engine;
                public $leftFrontWheel;
                public $rightFrontWheel;
                public $leftRearWheel;
                public $rightRearWheel;
            };
            $state->engine = new Engine($car, ...$this->engine);
            $state->leftFrontWheel = new Wheel($car, ...$this->wheels[0]);
            $state->rightFrontWheel = new Wheel($car, ...$this->wheels[1]);
            $state->leftRearWheel = new Wheel($car, ...$this->wheels[2]);
            $state->rightRearWheel = new Wheel($car, ...$this->wheels[3]);
            return $state;
        };
        return call_user_func($this->factory, $addDataToObject);
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