<?php

namespace Helium\ServiceManager\Tests\Fakes;

use Helium\ServiceManager\ServiceManager;

/**
 * @mixin FakeEngineContract
 */
class FakeServiceManager extends ServiceManager
{
	public static function create(): ServiceManager
	{
		return new FakeServiceManager();
	}

	public function chainMethod(): FakeEngineContract
	{
		return $this->engine()->chainMethod();
	}

	public function returnArray(): array
	{
		return $this->engine()->returnArray();
	}
}
