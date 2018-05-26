<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateCarConstructorDemo\Model;

class Car implements \JsonSerializable
{
    protected $engine;

    protected $leftFrontWheel;

    protected $rightFrontWheel;

    protected $leftRearWheel;

    protected $rightRearWheel;

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