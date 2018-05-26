<?php
declare(strict_types=1);

namespace StephanSchuler\PrivateCarConstructorDemo\Builder;

interface CarBuilder extends Builder
{
    public function setEngine(int $volume, int $performance): CarBuilder;

    public function addWheel(int $size): CarBuilder;
}