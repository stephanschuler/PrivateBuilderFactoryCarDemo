<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder;

use StephanSchuler\PrivateBuilderFactory\Model\Buildable;

trait BuilderTrait
{
    public static function getBuilderByClassName(string $builderClassName): Builder
    {
        static $factory;
        if (is_null($factory)) {
            $factory = function (callable $arguments): Buildable {
                $className = get_called_class();
                /** @var Buildable $target */
                $target = new $className;
                foreach ((array)$arguments($target) as $key => $value) {
                    if (property_exists($className, $key)) {
                        $target->{$key} = $value;
                    }
                }
                $target->initializeObject();
                return $target;
            };
        }
        return new $builderClassName($factory);
    }
}