<?php

/*
 * This file is part of the Alice package.
 *
 * (c) Nelmio <hello@nelm.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Nelmio\Alice\Instances;

use Nelmio\Alice\Util\FlagParser;

class Fixture {
	
	protected $class;
	protected $name;
	protected $spec;
	protected $classFlags;
	protected $nameFlags;
	protected $valueForCurrent;

	/**
	 * built a class representation of a fixture
	 *
	 * @param string $class
	 * @param string $name
	 * @param array $spec
	 * @param Processor $processor
	 * @param TypeHintChecker $typeHintChecker
	 * @param string $valueForCurrent - when <current()> is called, this value is used
	 */
	function __construct($class, $name, array $spec, $valueForCurrent) {
		list($this->class, $this->classFlags) = FlagParser::parse($class);
		list($this->name, $this->nameFlags)   = FlagParser::parse($name);
		
		$this->spec            = $spec;
		$this->valueForCurrent = $valueForCurrent;
	}

	public function getClass()
	{
		return $this->class;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getPropertyMap()
	{
		$propertyMap = $this->spec;
		if (!is_null($this->getConstructorArgs())) { unset($propertyMap['__construct']); };
		if (!is_null($this->getCustomSetter())) { unset($propertyMap['__set']); };
		return $propertyMap;
	}

	public function getClassFlags()
	{
		return $this->classFlags;
	}

	public function getNameFlags()
	{
		return $this->nameFlags;
	}

	public function getValueForCurrent()
	{
		return $this->valueForCurrent;
	}

	public function getConstructorArgs()
	{
		return $this->spec['__construct'];
	}

	public function getCustomSetter()
	{
		return $this->spec['__set'];
	}

}