<?php

declare(strict_types=1);

namespace CEKW\WpPlugin;

use ReflectionClass;

/**
 * Resolves attributes from a class.
 */
class AttributeResolver
{
    public function __construct(
        /**
         * Class name of the attribute to check against.
         */
        protected string $attributeClassName,
        /**
         * Reflection of the class to resolve attributes from.
         */
        protected ReflectionClass $reflectionClass
        // phpcs:ignore Squiz.WhiteSpace.ScopeClosingBrace
    ) {}

    /**
     * Resolves attributes from a method and provides a callback for each attribute.
     *
     * @param integer $flags Use `ReflectionAttribute::IS_INSTANCEOF` if you want to test against an interfac.
     */
    public function fromMethod(callable $callback, int $flags = 0)
    {
        foreach ($this->reflectionClass->getMethods() as $method) {
            $attributes = $method->getAttributes($this->attributeClassName, $flags);

            foreach ($attributes as $attribute) {
                call_user_func($callback, $attribute->newInstance(), $method);
            }
        }
    }
}