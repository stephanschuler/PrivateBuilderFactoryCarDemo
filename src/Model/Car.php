<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateBuilderFactory\Model;

use StephanSchuler\PrivateBuilderFactory\Builder\CarBuilderTrait;

class Car implements \JsonSerializable
{
    use CarBuilderTrait;

    protected $engine;

    protected $leftFrontWheel;

    protected $rightFrontWheel;

    protected $leftRearWheel;

    protected $rightRearWheel;

    private function __construct()
    {
    }

    private function initializeObject()
    {
    }

    public function jsonSerialize()
    {
        return [
            '__type' => 'Car',
            'engine' => $this->engine,
            'wheels' => [
                'leftFront' => $this->leftFrontWheel,
                'rightFront' => $this->rightFrontWheel,
                'leftRear' => $this->leftRearWheel,
                'rightRear' => $this->rightRearWheel,
            ],
        ];
    }
}