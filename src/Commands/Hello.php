<?php
declare(strict_types=1);
namespace Alesinicio\CLICommand\Commands;

class Hello implements CLICommandInterface {
	public function run(mixed ...$args) : void {
		echo sprintf("Hello %s!\n", $args[0] ?? 'noname');
	}
}