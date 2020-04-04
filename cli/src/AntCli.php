<?php
/**
 * @author Davi Lima <davi.n.lima99@gmail.com>
 */

namespace Antcli;

use Antcli\Terminal\Colors;

class AntCli
{
	/**
	 * Printe instance
	 *
	 * @var Printer
	 */
	protected $printer;

	/**
	 * Array action
	 *
	 * @var array
	 */
	protected $action = [];

	public function __construct(Printer $printer)
	{
		$this->printer = $printer;
	}

	/**
	 * Regiter a command
	 *
	 * @param string $command
	 * @param Closure $callable
	 * @return void
	 */
	public function register(string $command, $callable)
	{
		$this->action[$command] = $callable;
		return $this;
	}

	/**
	 * Return command
	 *
	 * @param array $action
	 * @return void
	 */
	public function getCommand($action)
	{
		return isset($this->action[$action]) ? $this->action[$action] : null;
	}

	/**
	 * Return printer
	 *
	 * @return Printer
	 */
	public function getPrinter()
	{
		return $this->printer;
	}

	/**
	 * Execute user command
	 *
	 * @param array $argv
	 * @return void
	 */
	public function runCommand(array $argv)
	{
		$commandName = 'help';
		if (isset($argv[1])) {
			$commandName = $argv[1];
		}

		$command = $this->getCommand($commandName);

		if (empty($command)) {
			echo "\n" . $this->getAllCommands() . "\n" ;
			return;
		}

		call_user_func($command, $argv);
	}
	
	/**
	 * Get all commands config
	 *
	 * @return void
	 */
	public function getAllCommands()
	{
		return Colors::RED . file_get_contents(__DIR__ . '/templates/all_commands.txt') . "\n" . Colors::END_COLOR;
	}
}
