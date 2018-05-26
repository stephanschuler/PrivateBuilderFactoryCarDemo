<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Model;

class Engine implements \JsonSerializable
{
    protected $car;

    protected $volume;

    protected $performance;

    public function __construct(Car $car, int $volume, int $performance)
    {
        $this->car = $car;
        $this->volume = $volume;
        $this->performance = $performance;
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