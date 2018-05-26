<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateCarConstructorDemo\Builder;

use StephanSchuler\PrivateCarConstructorDemo\Model\Car;
use StephanSchuler\PrivateCarConstructorDemo\Model\Engine;
use StephanSchuler\PrivateCarConstructorDemo\Model\Wheel;

trait CarBuilderTrait
{
    public static function build(callable $builderConfiguration): Car
    {
        /**
         * The $factory calls the constructor of this very class. So this function needs to know about
         * ordering of all constructor arguments.
         *
         * The here crete $car has no default constructor argument. Using a regular constructor would
         * result in creating $engines and $wheels before creating the car, so $engines and $wheels
         * would not know about the care they belong to.
         *
         * Instead, the car is created before $wheels and $engines are created. That way the $car object
         * can be constructor argument for every $engine and $wheel. After that $wheels and $engines
         * are assigned to the empty car before it is returned.
         *
         * Validation should go here.
         *
         * @var callable $factory
         */
        $factory = function ($engine, $wheels) {
            $className = get_called_class();

            /** @var Car $car */
            /** @var Car $this */
            $car = new $className;

            $car->engine = new Engine($car, ...$engine);
            $car->leftFrontWheel = new Wheel($car, ...$wheels[0]);
            $car->rightFrontWheel = new Wheel($car, ...$wheels[1]);
            $car->leftRearWheel = new Wheel($car, ...$wheels[2]);
            $car->rightRearWheel = new Wheel($car, ...$wheels[3]);

            return $car;
        };

        /**
         * The $builder provides a fluent interface to configure several properties of this very class in
         * an arbitrary order.
         *
         * Each property setting does not create a nested object directly but basically provides constructor
         * arguments.
         *
         * @var CarBuilder $builder
         */
        $builder = new class($factory) implements CarBuilder
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

            public function setEngine(int $volume, int $performance): CarBuilder
            {
                $this->engine = [$volume, $performance];
                return $this;
            }

            public function addWheel(int $size): CarBuilder
            {
                $this->wheels[] = [$size];
                return $this;
            }
        };

        /**
         * The $builderConfiguration is the connection fron the outside world to the
         * transaction step: It adjusts the $builder object to have it set up in a
         * proper state.
         */
        $builderConfiguration($builder);

        /*
         * Kindly ask the builder to create a new object based on the current builder
         * configuration.
         */
        return $builder();
    }
}