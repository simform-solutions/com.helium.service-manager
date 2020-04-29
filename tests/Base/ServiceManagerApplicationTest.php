<?php

namespace Helium\ServiceManager\Tests\Base;

use Exception;
use Helium\ServiceManager\EngineContract;
use Helium\ServiceManager\Exceptions\InvalidEngineException;
use Helium\ServiceManager\Exceptions\UnknownEngineException;
use Helium\ServiceManager\ServiceManager;
use Helium\ServiceManager\Tests\Fakes\NotAnEngine;
use Illuminate\Foundation\Testing\TestCase;

abstract class ServiceManagerApplicationTest extends TestCase
{
	protected abstract function getInstance(): ServiceManager;

	protected abstract function getNewEngine(): EngineContract;

	public abstract function testPassthroughReturnsExpected();

	public function testExtendReturnsSelf()
	{
		$manager = $this->getInstance();

		$this->assertEquals(
			$manager,
			$manager->extend('fake', $this->getNewEngine())
		);
	}

	public function testDefaultEngine()
	{
		$manager = $this->getInstance();

		$this->assertInstanceOf(
			$manager->getEngineContract(),
			$manager->engine()
		);
	}

	public function testSpecificEngine()
	{
		$manager = $this->getInstance();

		$newEngine = $this->getNewEngine();

		$manager->extend('fake2', $newEngine);

		$this->assertEquals(
			$newEngine,
			$manager->engine('fake2')
		);
	}

	public function testUnknownEngineThrowsException()
	{
		$manager = $this->getInstance();

		try
		{
			$engine = $manager->engine('unknownEngine');

			$this->assertTrue(false);
		}
		catch (Exception $e)
		{
			$this->assertInstanceOf(UnknownEngineException::class, $e);
			$this->assertStringContainsString('unknownEngine', $e->getMessage());
		}
	}

	public function testInvalidEngineThrowsException()
	{
		$manager = $this->getInstance();

		try
		{
			$engine = $manager->extend('notAnEngine', new NotAnEngine);

			$this->assertTrue(false);
		}
		catch (Exception $e)
		{
			$this->assertInstanceOf(InvalidEngineException::class, $e);
			$this->assertStringContainsString('notAnEngine', $e->getMessage());
		}
	}
}