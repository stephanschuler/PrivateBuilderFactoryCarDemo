<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder\Engine;

use StephanSchuler\PrivateBuilderFactory\Builder\BuilderTrait;
use StephanSchuler\PrivateBuilderFactory\Model\Engine;

trait EngineBuilderTrait
{
    use BuilderTrait;

    public static function build(callable $builderConfiguration): Engine
    {
        /**
         * The $builder provides a fluent interface to configure several properties of this very class in
         * an arbitrary order.
         *
         * Each property setting does not create a nested object directly but basically provides constructor
         * arguments.
         *
         * @var EngineBuilder $builder
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

    public static function getBuilder(): EngineBuilder
    {
        return self::getBuilderByClassName(EngineBuilder::class);
    }
}