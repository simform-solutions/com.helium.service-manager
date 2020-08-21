<?php

namespace Helium\ServiceManager;

use Helium\ServiceManager\Exceptions\InvalidEngineException;
use Helium\ServiceManager\Exceptions\UnknownEngineException;

abstract class ServiceManager
{
	//region Base
	protected static $engines = [];

    /**
     * @description Get the name of the default engine
     * @return string
     */
	abstract protected static function getDefaultEngineName(): string;

	/**
	 * @description Get the classname of your service engine contract
	 * @return string
	 */
	abstract protected static function getEngineContract(): string;
	//endregion

	//region Engines
	/**
	 * @description Inject engine dependency
	 * @param string $key
	 * @param EngineContract $engine
	 */
	public static function extend(string $key, EngineContract $engine)
	{
		if (!is_a($engine, static::getEngineContract()))
		{
			throw new InvalidEngineException(
				$key,
				static::getEngineContract(),
				get_class($engine)
			);
		}

		self::$engines[$key] = $engine;
	}

	/**
	 * @description Retrieve specified or default engine
	 * @param string|null $key
	 * @return EngineContract
	 */
	public static function engine(string $key = null): EngineContract
	{
		/**
		 * If no key is specified, use the default
		 */
		$key = $key ?? static::getDefaultEngineName();

		/**
		 * If the specified engine does not exist, throw an exception
		 */
		if (!isset(self::$engines[$key]))
		{
			throw new UnknownEngineException(static::class, $key);
		}

		return self::$engines[$key];
	}
	//endregion
}
