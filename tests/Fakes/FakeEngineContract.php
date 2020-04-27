<?php

namespace Helium\ServiceManager\Tests\Fakes;

use Helium\ServiceManager\EngineContract;

interface FakeEngineContract extends EngineContract
{
	public function chainMethod(): FakeEngineContract;

	public function returnArray(): array;
}