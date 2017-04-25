<?php

trait Messages {
	protected function printMessage(string $message): void {
		echo $message . '<br>';
	}
}