<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder;

use StephanSchuler\PrivateBuilderFactory\Model\Car;

trait CarBuilderTrait
{
    public static function build(callable $builderConfiguration): Car
    {
        /**
         * The $builder provides a fluent interface to configure several properties of this very class in
         * an arbitrary order.
         *
         * Each property setting does not create a nested object directly but basically provides constructor
         * arguments.
         *
         * @var CarBuilder $builder
         */
        $builder = self::getBuilder();

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

    public static function getBuilder(): CarBuilder
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
         * @return Car
         */
        static $factory;
        if (is_null($factory)) {
            $factory = function (callable $arguments): Car {
                /** @var Car $car */
                $className = get_called_class();
                $car = new $className;
                foreach ((array)$arguments($car) as $key => $value) {
                    if (property_exists($className, $key)) {
                        $car->{$key} = $value;
                    }
                }
                $car->initializeObject();
                return $car;
            };
        }
        return new CarBuilder($factory);
    }

    protected function __set_state()
    {

    }
}