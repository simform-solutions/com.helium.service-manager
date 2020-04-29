<?php

namespace Helium\ServiceManager\Tests\Fakes;

use Helium\ServiceManager\EngineContract;

class NotAnEngine implements EngineContract
{
	public function chainMethod(): FakeEngineContract
	{
		return $this;
	}

	public function returnArray(): array
	{
		return [];
	}
}