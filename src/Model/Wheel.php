<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateCarConstructorDemo\Model;

class Wheel implements \JsonSerializable
{
    protected $car;

    protected $size;

    public function __construct(Car $car, int $size)
    {
        $this->car = $car;
        $this->size = $size;
    }

    public function jsonSerialize()
    {
        return [
            '__type' => 'Wheel',
            'size' => $this->size,
        ];
    }
}