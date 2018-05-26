<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Model;

use StephanSchuler\PrivateBuilderFactory\Builder\Engine\EngineBuilderTrait;

class Engine implements Buildable, \JsonSerializable
{
    use EngineBuilderTrait;

    protected $car;

    protected $volume;

    protected $performance;

    private function __construct()
    {
    }

    private function initializeObject()
    {
    }

    public function jsonSerialize()
    {
        return [
            '__type' => 'Engine',
            'volume' => $this->volume,
            'performance' => $this->performance,
        ];
    }
}