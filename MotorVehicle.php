<?php

require_once 'Vehicle.php';


abstract class MotorVehicle extends Vehicle {
	private $horsePower;

	public function __construct(string $color, float $size, int $horsePower) {
		parent::__construct($color, $size);

		$this->horsePower = $horsePower;
	}
}
