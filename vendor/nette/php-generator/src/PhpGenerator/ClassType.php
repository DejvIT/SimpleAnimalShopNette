<?php

/**
 * This file is part of the Nette Framework (https://nette.org)
 * Copyright (c) 2004 David Grudl (https://davidgrudl.com)
 */

declare(strict_types=1);

namespace Nette\PhpGenerator;

use Nette;


/**
 * Class description.
 */
final class ClassType extends ClassLike
{
	use Traits\ConstantsAware;
	use Traits\MethodsAware;
	use Traits\PropertiesAware;
	use Traits\TraitsAware;

	/** @deprecated */
	public const
		TYPE_CLASS = 'class',
		TYPE_INTERFACE = 'interface',
		TYPE_TRAIT = 'trait',
		TYPE_ENUM = 'enum';

	private bool $final = false;
	private bool $abstract = false;
	private ?string $extends = null;
	private bool $readOnly = false;

	/** @var string[] */
	private array $implements = [];


	/** @deprecated  create object using 'new Nette\PhpGenerator\ClassType' */
	public static function class(?string $name): self
	{
		trigger_error(__METHOD__ . "() is deprecated, create object using 'new Nette\\PhpGenerator\\ClassType", E_USER_DEPRECATED);
		return new self($name);
	}


	/** @deprecated  create object using 'new Nette\PhpGenerator\InterfaceType' */
	public static function interface(string $name): InterfaceType
	{
		trigger_error(__METHOD__ . "() is deprecated, create object using 'new Nette\\PhpGenerator\\InterfaceType'", E_USER_DEPRECATED);
		return new InterfaceType($name);
	}


	/** @deprecated  create object using 'new Nette\PhpGenerator\TraitType' */
	public static function trait(string $name): TraitType
	{
		trigger_error(__METHOD__ . "() is deprecated, create object using 'new Nette\\PhpGenerator\\TraitType'", E_USER_DEPRECATED);
		return new TraitType($name);
	}


	/** @deprecated  create object using 'new Nette\PhpGenerator\EnumType' */
	public static function enum(string $name): EnumType
	{
		trigger_error(__METHOD__ . "() is deprecated, create object using 'new Nette\\PhpGenerator\\EnumType'", E_USER_DEPRECATED);
		return new EnumType($name);
	}


	public function __construct(?string $name = null, ?PhpNamespace $namespace = null)
	{
		if ($name === null) {
			parent::__construct('foo', $namespace);
			$this->setName(null);
		} else {
			parent::__construct($name, $namespace);
		}
	}


	/** @deprecated */
	public function getType(): string
	{
		trigger_error(__METHOD__ . "() is deprecated, method always returns 'class'", E_USER_DEPRECATED);
		return self::TYPE_CLASS;
	}


	public function setFinal(bool $state = true): static
	{
		$this->final = $state;
		return $this;
	}


	public function isFinal(): bool
	{
		return $this->final;
	}


	public function setAbstract(bool $state = true): static
	{
		$this->abstract = $state;
		return $this;
	}


	public function isAbstract(): bool
	{
		return $this->abstract;
	}


	public function setReadOnly(bool $state = true): static
	{
		$this->readOnly = $state;
		return $this;
	}


	public function isReadOnly(): bool
	{
		return $this->readOnly;
	}


	public function setExtends(?string $name): static
	{
		if ($name) {
			$this->validateNames([$name]);
		}
		$this->extends = $name;
		return $this;
	}


	public function getExtends(): ?string
	{
		return $this->extends;
	}


	/**
	 * @param  string[]  $names
	 */
	public function setImplements(array $names): static
	{
		$this->validateNames($names);
		$this->implements = $names;
		return $this;
	}


	/** @return string[] */
	public function getImplements(): array
	{
		return $this->implements;
	}


	public function addImplement(string $name): static
	{
		$this->validateNames([$name]);
		$this->implements[] = $name;
		return $this;
	}


	public function removeImplement(string $name): static
	{
		$this->implements = array_diff($this->implements, [$name]);
		return $this;
	}


	public function addMember(Method|Property|Constant|TraitUse $member, bool $overwrite = false): static
	{
		$name = $member->getName();
		[$type, $n] = match (true) {
			$member instanceof Constant => ['consts', $name],
			$member instanceof Method => ['methods', strtolower($name)],
			$member instanceof Property => ['properties', $name],
			$member instanceof TraitUse => ['traits', $name],
		};
		if (!$overwrite && isset($this->$type[$n])) {
			throw new Nette\InvalidStateException("Cannot add member '$name', because it already exists.");
		}
		$this->$type[$n] = $member;
		return $this;
	}


	/**
	 * Inherits property from parent class.
	 */
	public function inheritProperty(string $name, bool $returnIfExists = false): Property
	{
		if (isset($this->properties[$name])) {
			return $returnIfExists
				? $this->properties[$name]
				: throw new Nette\InvalidStateException("Cannot inherit property '$name', because it already exists.");

		} elseif (!$this->extends) {
			throw new Nette\InvalidStateException("Class '{$this->getName()}' has not setExtends() set.");
		}

		try {
			$rp = new \ReflectionProperty($this->extends, $name);
		} catch (\ReflectionException) {
			throw new Nette\InvalidStateException("Property '$name' has not been found in ancestor {$this->extends}");
		}

		return $this->properties[$name] = (new Factory)->fromPropertyReflection($rp);
	}


	/**
	 * Inherits method from parent class or interface.
	 */
	public function inheritMethod(string $name, bool $returnIfExists = false): Method
	{
		$lower = strtolower($name);
		$parents = [...(array) $this->extends, ...$this->implements];
		if (isset($this->methods[$lower])) {
			return $returnIfExists
				? $this->methods[$lower]
				: throw new Nette\InvalidStateException("Cannot inherit method '$name', because it already exists.");

		} elseif (!$parents) {
			throw new Nette\InvalidStateException("Class '{$this->getName()}' has neither setExtends() nor setImplements() set.");
		}

		foreach ($parents as $parent) {
			try {
				$rm = new \ReflectionMethod($parent, $name);
			} catch (\ReflectionException) {
				continue;
			}
			return $this->methods[$lower] = (new Factory)->fromMethodReflection($rm);
		}

		throw new Nette\InvalidStateException("Method '$name' has not been found in any ancestor: " . implode(', ', $parents));
	}


	/** @throws Nette\InvalidStateException */
	public function validate(): void
	{
		$name = $this->getName();
		if ($name === null && ($this->abstract || $this->final)) {
			throw new Nette\InvalidStateException('Anonymous class cannot be abstract or final.');

		} elseif ($this->abstract && $this->final) {
			throw new Nette\InvalidStateException("Class '$name' cannot be abstract and final at the same time.");
		}
	}


	public function __clone(): void
	{
		parent::__clone();
		$clone = fn($item) => clone $item;
		$this->consts = array_map($clone, $this->consts);
		$this->methods = array_map($clone, $this->methods);
		$this->properties = array_map($clone, $this->properties);
		$this->traits = array_map($clone, $this->traits);
	}
}
