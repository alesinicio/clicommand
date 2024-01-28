<?php
declare(strict_types=1);
namespace Alesinicio\CLICommand;

use Alesinicio\CLICommand\Commands\CLICommandInterface;

class CommandCollection {
	/* @var array<string, class-string<CLICommandInterface> */
	private array $commands = [];

	/**
	 * @template T of CLICommandInterface
	 * @param string          $command
	 * @param class-string<T> $class
	 * @return $this
	 */
	public function addCommand(string $command, string $class) : self {
		$this->commands[$command] = $class;
		return $this;
	}
	public function getCommands() : array {
		return $this->commands;
	}
}