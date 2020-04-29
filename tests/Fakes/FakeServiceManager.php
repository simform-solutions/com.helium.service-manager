<?php

namespace Helium\ServiceManager\Tests\Fakes;

use Helium\ServiceManager\EngineContract;
use Helium\ServiceManager\ServiceManager;

/**
 * @mixin FakeEngineContract
 */
class FakeServiceManager extends ServiceManager
{
	public function getEngineContract(): string
	{
		return FakeEngineContract::class;
	}

	protected function createDefaultEngine(): EngineContract
	{
		return new FakeEngine();
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
