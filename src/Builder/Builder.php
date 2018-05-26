<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Builder;

/**
 * A builder doesn't actually build an object but holds information about the
 * object to be created.
 */
interface Builder
{
    /**
     * The $factory callable should only be registered with the Builder here.
     *
     * @param callable $factory
     */
    public function __construct(callable $factory);

    /**
     * When the Builder is invoked, every adjustment to the target configuration
     * of the object to be created is done. Just execute the $factory method
     * registered on __construct and pass the Builder $this to the $factory.
     *
     * @return mixed
     */
    public function __invoke();
}