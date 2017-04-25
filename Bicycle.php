<?php

require_once 'Vehicle.php';
require_once 'RackMountable.php';
require_once 'Messages.php';

class Bicycle extends Vehicle implements RackMountable {
	use Messages;

	protected $axis = 2;

	private $rackMounted = false;

	public function mountRack(): void {
		$this->printMessage('Mounting rack on bicycle...');
		$this->rackMounted = true;
		$this->printMessage('Ready for an adventure into the nature!');
	}

	public function dismountRack(): void {
		$this->printMessage('Dismounting rack from bicycle...');
		$this->rackMounted = false;
	}

	public function isRackMounted(): bool {
		return $this->rackMounted;
	}
}
