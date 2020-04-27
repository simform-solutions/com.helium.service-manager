<?php

namespace Helium\ServiceManager;

use Helium\ServiceManager\Exceptions\UnknownEngineException;

abstract class ServiceManager
{
	//region Base
	protected $defaultEngine;
	protected $engines = [];

	public function __construct($key)
	{
		$this->defaultEngine = $key;
	}

	/**
	 * @description Create a ready-to-use ServiceManager instance
	 * @return static
	 */
	public abstract static function create(): ServiceManager;
	//endregion

	//region Engines
	/**
	 * @description Inject engine dependency
	 * @param string $key
	 * @param EngineContract $engine
	 * @return static
	 */
	public function extend(string $key, EngineContract $engine): ServiceManager
	{
		$this->engines[$key] = $engine;

		return $this;
	}

	/**
	 * @description Retrieve specified or default engine
	 * @param string|null $key
	 * @return EngineContract
	 */
	public function engine(string $key = null): EngineContract
	{
		/**
		 * If no key is specified, use the default
		 */
		$key = $key ?? $this->defaultEngine;

		/**
		 * If the specified engine does not exist, throw an exception
		 */
		if (!isset($this->engines[$key]))
		{
			throw new UnknownEngineException(static::class, $key);
		}

		return $this->engines[$key];
	}
	//endregion
}
