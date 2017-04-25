<?php

require 'Car.php';
require 'Motorbike.php';
require 'Bicycle.php';

$car = new Car('blue', 120);
$motorbike = new Motorbike('yellow', 1.8, 141);
$bicycle = new Bicycle('green', 1.6);

// The bike driver likes a mounted rack
$bicycle->mountRack();

// The motorbike driver doesn't though
$motorbike->mountRack();
$motorbike->dismountRack();

// We can drive with each vehicle. The motorbike driver wants to take a brake though...
$car->drive(320);
$motorbike->drive(200);
$bicycle->drive(30);