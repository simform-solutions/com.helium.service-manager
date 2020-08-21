<?php

namespace Helium\ServiceManager;

abstract class Facade
{
	/**
	 * @description Do not allow facade instances to be created. All functions
	 * should be static calls.
	 */
	final private function __construct()
	{
	}
}