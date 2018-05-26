<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder\Car;

use StephanSchuler\PrivateBuilderFactory\Builder\Builder;
use StephanSchuler\PrivateBuilderFactory\Builder\Engine\EngineBuilder;
use StephanSchuler\PrivateBuilderFactory\Builder\Wheel\WheelBuilder;
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
            $state->engine = Engine::build(function (EngineBuilder $engine) use ($car) {
                $engine->setCar($car);
                $engine->setVolume($this->engine[0]);
                $engine->setPerformance($this->engine[1]);
            });
            $state->leftFrontWheel = Wheel::build(function (WheelBuilder $wheel) use ($car) {
                $wheel->setCar($car);
                $wheel->setSize($this->wheels[0]);
            });
            $state->rightFrontWheel = Wheel::build(function (WheelBuilder $wheel) use ($car) {
                $wheel->setCar($car);
                $wheel->setSize($this->wheels[1]);
            });
            $state->leftRearWheel = Wheel::build(function (WheelBuilder $wheel) use ($car) {
                $wheel->setCar($car);
                $wheel->setSize($this->wheels[2]);
            });
            $state->rightRearWheel = Wheel::build(function (WheelBuilder $wheel) use ($car) {
                $wheel->setCar($car);
                $wheel->setSize($this->wheels[3]);
            });
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
        $this->wheels[] = $size;
        return $this;
    }
}