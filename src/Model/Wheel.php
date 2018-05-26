<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Model;

use StephanSchuler\PrivateBuilderFactory\Builder\Wheel\WheelBuilderTrait;

class Wheel implements Buildable, \JsonSerializable
{
    use WheelBuilderTrait;

    protected $car;

    protected $size;

    private function __construct()
    {
    }

    private function initializeObject()
    {
    }

    public function jsonSerialize()
    {
        return [
            '__type' => 'Wheel',
            'size' => $this->size,
        ];
    }
}