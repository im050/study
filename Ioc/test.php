<?php

include 'DI.php';
include 'Wheel.php';
include 'Car.php';

$di = new DI();

$di->singleton('wheel', function () {
    return new Wheel();
});

$di->register('car', function () use ($di) {
    $wheel = $di->get('wheel');
    return new Car($wheel);
});

$car = $di->get('car');

$car->run();

$car2 = $di->get('car');

$car2->run();