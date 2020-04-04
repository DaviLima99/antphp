<?php

namespace Antcli;

class Printer
{

	public function out(string $message) : void
	{	
		echo $message;
	}

	public function newLine() : void
	{
		$this->out("\n");
	}

	public function display(string $message) : void
	{
		$this->newLine();
		$this->out($message);
		$this->newLine();
		$this->newLine();
	}


}
