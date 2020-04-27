<?php

namespace Helium\ServiceManager\Tests;

use Helium\ServiceManager\EngineContract;
use Helium\ServiceManager\ServiceManager;
use Helium\ServiceManager\Tests\Base\ServiceManagerPackageTest;
use Helium\ServiceManager\Tests\Fakes\FakeEngine;
use Helium\ServiceManager\Tests\Fakes\FakeServiceManager;

class ServiceManagerTest extends ServiceManagerPackageTest
{
	protected function getInstance(): ServiceManager
	{
		$manager = new FakeServiceManager('fake');

		$manager->extend('fake', $this->getNewEngine());

		return $manager;
	}

	protected function getNewEngine(): EngineContract
	{
		return new FakeEngine();
	}

	public function testPassthroughReturnsExpected()
	{
		$manager = $this->getInstance();

		$this->assertEquals(
			$manager->engine(),
			$manager->chainMethod()
		);

		$this->assertIsArray($manager->returnArray());
	}
}