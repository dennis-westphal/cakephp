<?php

require_once 'MotorVehicle.php';

class Car extends MotorVehicle {
	protected $axis = 4;

    public function __construct(string $color, int $horsePower, float $size = 2.8) {
    	parent::__construct($color, $size, $horsePower);
    }
}
