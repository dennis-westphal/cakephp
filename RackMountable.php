<?php

interface RackMountable {
	public function mountRack();
	public function dismountRack();
	public function isRackMounted(): bool;
}
