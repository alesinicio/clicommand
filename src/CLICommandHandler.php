<?php
declare(strict_types=1);
namespace Alesinicio\CLICommand;

use Alesinicio\CLICommand\Commands\CLICommandInterface;
use Alesinicio\CLICommand\Exceptions\CLICommandUnexistentException;
use Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;

class CLICommandHandler {
	private readonly array $commands;
	public function __construct(
		private readonly CommandCollection  $commandCollection,
		private readonly LoggerInterface    $logger,
		private readonly ContainerInterface $container,
	) {
		$this->commands = $this->commandCollection->getCommands();
	}
	/**
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 * @throws Exception
	 */
	public function handle(int $argc, array $argv) : void {
		if (($argc < 2) || !isset($this->commands[$argv[1]])) {
			$this->logger->debug('Usage: php script.php [command]');
			$this->logger->debug('Available commands', ['commands' => array_keys($this->commands)]);
			exit(1);
		}

		$command      = $argv[1];
		$commandClass = $this->commands[$command];
		$command      = $this->container->get($commandClass);
		if (!($command instanceof CLICommandInterface)) throw new CLICommandUnexistentException();
		$command->run(...array_slice($argv, 2));
	}
}