<?php

namespace Helium\ServiceManager\Exceptions;

use InvalidArgumentException;

class UnknownEngineException extends InvalidArgumentException
{
	/**
	 * @description An unknown engine was referenced
	 * @param string $key
	 */
	public function __construct(string $class, string $key)
	{
		$message = "Unknown engine '{$key}' in {$class}";

		parent::__construct($message);
	}
}