<?php

abstract class Vehicle {
	private $color;
	private $size;

	protected $location = 0;
	protected $axis;

	public function __construct(string $color, float $size) {
		$this->color = $color;
		$this->size = $size;
	}

	public function drive(int $distance): void {
		echo get_class($this) . ' driving ' . $distance . ' km'.'<br>';
		$this->location += $distance;
	}
}
