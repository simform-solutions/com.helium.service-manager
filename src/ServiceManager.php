<?php

namespace Helium\ServiceManager;

use Helium\ServiceManager\Exceptions\InvalidEngineException;
use Helium\ServiceManager\Exceptions\UnknownEngineException;

abstract class ServiceManager
{
	//region Base
	protected $defaultEngine = 'default';
	protected $instanceDefaultEngine;
	protected $engines = [];

	public function __construct(string $defaultEngine = null)
	{
		$this->instanceDefaultEngine = $defaultEngine ?? $this->defaultEngine;

		$this->extend(
			$this->instanceDefaultEngine,
			$this->createDefaultEngine()
		);
	}

	/**
	 * @description Create a ready-to-use ServiceManager instance
	 * @return static
	 */
	public static function create(): ServiceManager
	{
		return new static();
	}

	/**
	 * @description Get the classname of your service engine contract
	 * @return string
	 */
	public abstract function getEngineContract(): string;

	/**
	 * @description Create the default engine for your service
	 * @return EngineContract
	 */
	protected abstract function createDefaultEngine(): EngineContract;
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
		if (!is_a($engine, $this->getEngineContract()))
		{
			throw new InvalidEngineException(
				$key,
				$this->getEngineContract(),
				get_class($engine)
			);
		}

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
		$key = $key ?? $this->instanceDefaultEngine;

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
