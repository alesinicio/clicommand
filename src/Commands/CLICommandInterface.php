<?php
declare(strict_types=1);
namespace Alesinicio\CLICommand\Commands;

interface CLICommandInterface {
	public function run(mixed ...$args) : void;
}