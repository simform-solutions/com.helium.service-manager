<?php

namespace Helium\ServiceManager\Exceptions;

use InvalidArgumentException;

class InvalidEngineException extends InvalidArgumentException
{
	/**
	 * @description An unknown engine was referenced
	 * @param string $key
	 */
	public function __construct(string $key, string $expected, string $actual)
	{
		$message = "Invalid engine given for '{$key}'. Expected {$expected}, ";
		$message .= "got {$actual}";

		parent::__construct($message);
	}
}