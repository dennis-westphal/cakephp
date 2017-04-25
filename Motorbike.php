<?php

require_once 'MotorVehicle.php';
require_once 'RackMountable.php';
require_once 'Messages.php';

class Motorbike extends MotorVehicle implements RackMountable {
	use Messages;

	protected $axis = 2;

	public const BREAK_AFTER = 100;

	private $rackMounted = false;

	public function drive(int $distance): void {
		parent::drive($distance);

		if($this->location >= self::BREAK_AFTER) {
			$this->printMessage('I need a break!');
		}
	}

	public function mountRack(): void {
		$this->printMessage('Mounting rack on motorbike...');
		$this->rackMounted = true;
		$this->printMessage('This just looks ridiculous');
	}

	public function dismountRack(): void {
		$this->printMessage('Dismounting rack from motorbike...');
		$this->rackMounted = false;
		$this->printMessage('Much better');
	}

	public function isRackMounted(): bool {
		return $this->rackMounted;
	}
}
