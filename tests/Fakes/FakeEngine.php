<?php

namespace Helium\ServiceManager\Tests\Fakes;

class FakeEngine implements FakeEngineContract
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