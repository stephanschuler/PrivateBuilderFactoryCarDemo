<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder\Wheel;

use StephanSchuler\PrivateBuilderFactory\Builder\Builder;
use StephanSchuler\PrivateBuilderFactory\Model\Car;
use StephanSchuler\PrivateBuilderFactory\Model\Wheel;

class WheelBuilder implements Builder
{
    private $factory;

    protected $car;

    protected $size;

    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function __invoke()
    {
        $addDataToObject = function (Wheel $wheel) {
            $state = new class
            {
                public $car;
                public $size;
            };
            $state->car = $this->car;
            $state->size = $this->size;
            return $state;
        };
        return call_user_func($this->factory, $addDataToObject);
    }

    public function setCar(Car $car): WheelBuilder
    {
        $this->car = $car;
        return $this;
    }

    public function setSize(int $size): WheelBuilder
    {
        $this->size = $size;
        return $this;
    }
}