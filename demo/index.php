<?php

use Composer\Autoload\ClassLoader;
use StephanSchuler\PrivateBuilderFactory\Builder\CarBuilder;
use StephanSchuler\PrivateBuilderFactory\Model\Car;

/** @var ClassLoader $autoloader */
$autoloader = require_once __DIR__ . '/../vendor/autoload.php';

$car1 = Car::build(function (CarBuilder $car) {
    /*
     * This is not an actual car but only a list of parts. The car object is created
     * automatically just after this closure returns.
     */
    $car
        ->setEngine(3.0, 350)
        ->addWheel(20)
        ->addWheel(20)
        ->addWheel(21)
        ->addWheel(21);
});

$car2 = Car::build(function (CarBuilder $car) {
    /*
     * This is not an actual car but only a list of parts. The car object is created
     * automatically just after this closure returns.
     */
    $car
        ->addWheel(16)
        ->addWheel(16)
        ->addWheel(16)
        ->addWheel(16)
        ->setEngine(1.8, 90);
});

$car3 = Car::getBuilder()
    ->addWheel(18)
    ->addWheel(18)
    ->addWheel(18)
    ->addWheel(18)
    ->setEngine(2.0, 90)
    ->__invoke();

printf(
    '<pre>%s</pre>',
    json_encode([
        $car1,
        $car2,
        $car3,
    ])
);